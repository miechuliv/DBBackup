<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 08.07.14
 * Time: 12:07
 * To change this template use File | Settings | File Templates.
 */
include_once(__DIR__.'/../ConcreteExample.php');

class ConcteteExampleTest extends PHPUnit_Framework_TestCase{

    public function testOutput()
    {
        $concreteClass = new ConcreteExample();

        $concreteClass->backupTables(array(),array('product','category'));

        $this->assertStringStartsWith("DROP",$concreteClass->showOutput());

        $concreteClass->saveOutput();
    }


}