<?php

namespace NfeFocus;

class EnviromentTest extends \PHPUnit_Framework_TestCase
{

    public function testDevelopment()
    {
        $enviroment = Enviroment::DEVELOPMENT;
        $this->assertEquals(1, $enviroment);

    }

    public function testProduction()
    {
        $enviroment = Enviroment::PRODUCTION;
        $this->assertEquals(2, $enviroment);

    }

}