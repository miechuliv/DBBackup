<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 08.07.14
 * Time: 11:41
 * To change this template use File | Settings | File Templates.
 */
include_once(__DIR__.'/DBBackup.php');
class ConcreteExample extends DBBackup{

    protected function _getAllTableNames()
    {
        return array(
           'product',
           'category',
           'orders',
           'options',
        );
    }

    protected function _getAllTableRows($table)
    {
        if($table == 'product')
        {
            return array(
                0 => array(
                    'name' => 'sdfdsfds',
                    'price' => '0.56',
                    'id' => '1',
                ),
                1 => array(
                    'name' => 'nananana',
                    'price' => '0.78',
                    'id' => '2',
                ),
            );
        }

        if($table == 'category')
        {
            return array(
                0 => array(
                    'name' => 'sdfdsfds',
                    'id' => '1',
                ),
                1 => array(
                    'name' => 'nananana',
                    'id' => '2',
                ),
            );
        }

        return array();
    }

    protected function _createTable($table)
    {
        if($table == 'product')
        {
            return    "CREATE TABLE `product` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL,
 `price` float() NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        }

        if($table == 'category')
        {
            return    "CREATE TABLE `category` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        }

        return '';
    }

    public function showOutput()
    {
        return $this->_output;
    }

    public function saveOutput()
    {
        file_put_contents(__DIR__.'/result.sql',$this->_output);
    }
}