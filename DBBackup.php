<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 08.07.14
 * Time: 10:59
 * To change this template use File | Settings | File Templates.
 */

abstract class DBBackup {

    protected $_allowedTables;
    protected $_output;

    /**
     * @return array
     */
    abstract protected function _getAllTableNames();

    /**
     * @return array
     */
    abstract protected function _getAllTableRows($table);

    /**
     * @return string
     */
    abstract protected function _createTable($table);

    /**
     * @param array $tableKeywords
     * @param array $allowedTables
     * @return bool
     */
    public function backupTables($tableKeywords = array(),$allowedTables = array())
    {



        $results = $this->_getAllTableNames();

        $tables = array();

        foreach($results as $result)
        {
            // look for tables containing words
            if($tableKeywords)
            {
                foreach($tableKeywords as $keyword)
                {
                    if(stripos($result,$keyword)!==false)
                    {
                        $tables[] = $result;
                        continue;
                    }
                }
            }

            // look for tables exactly like
            if($allowedTables && in_array($result,$allowedTables))
            {
                $tables[] = $result;
            }

        }

        $return = '';

        foreach($tables as $table)
        {
            $result = $this->_getAllTableRows($table);
            $num_fields = count($result);


            $return .= 'DROP TABLE '.$table.';';
            $row2 = $this->_createTable($table);
            $return.= "\n\n".$row2.";\n\n";

            foreach($result as $row)
            {
                $num_fields = count($row);
                $j = 0;
                $return.= 'INSERT INTO '.$table.' VALUES(';
                foreach($row as $field => $val)
                {
                    $val = addslashes($val);


                    $val = str_replace("\n","\\n",$val);
                    if (isset($val)) { $return.= '"'.$val.'"' ; } else { $return.= '""'; };
                    if ($j<($num_fields-1)) { $return.= ','; };
                    $j++;
                }

                $return.= ");\n";

            }

            $return.="\n\n\n";
        }

        $this->_output = $return;


    }

    /**
 * @return string
 */
    abstract public function showOutput();

    /**
     * @return void
     */
    abstract public function saveOutput();

}