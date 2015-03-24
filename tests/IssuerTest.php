<?php

namespace NfeFocus;

class IssuerTest extends \PHPUnit_Framework_TestCase
{

    public function testValidaCompanyDocument()
    {
        $cnpj = '47.377.613/0001-06';

        $issuer = new Issuer;
        $issuer->setCompanyDocument($cnpj);

        $this->assertEquals('47377613000106', $issuer->getCompanyDocument());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testInvalidCompanyDocument()
    {
        $cnpj = '47.377.613/0001-00';

        $issuer = new Issuer;
        $issuer->setCompanyDocument($cnpj);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyCompanyDocument()
    {
        $cnpj = '';

        $issuer = new Issuer;
        $issuer->setCompanyDocument($cnpj);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testNullCompanyDocument()
    {
        $cnpj = null;

        $issuer = new Issuer;
        $issuer->setCompanyDocument($cnpj);
    }

    public function testValidaCompanyName()
    {
        $companyName = 'DIN DIGITAL WEB LTDA ME';

        $issuer = new Issuer;
        $issuer->setCompanyName($companyName);

        $this->assertEquals($companyName, $issuer->getCompanyName());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyCompanyName()
    {
        $companyName = '';

        $issuer = new Issuer;
        $issuer->setCompanyName($companyName);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testNullCompanyName()
    {
        $companyName = null;

        $issuer = new Issuer;
        $issuer->setCompanyName($companyName);
    }


    public function testValidaTradingName()
    {
        $tradingName = 'DIN DIGITAL';

        $issuer = new Issuer;
        $issuer->setTradingName($tradingName);

        $this->assertEquals($tradingName, $issuer->getTradingName());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyTradingName()
    {
        $tradingName = '';

        $issuer = new Issuer;
        $issuer->setTradingName($tradingName);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testNullTradingName()
    {
        $tradingName = null;

        $issuer = new Issuer;
        $issuer->setCompanyName($tradingName);
    }


    public function testValidaStateRegistration()
    {
        $stateRegistration = '123.456.789-10';

        $issuer = new Issuer;
        $issuer->setStateRegistration($stateRegistration);

        $this->assertEquals('12345678910', $issuer->getStateRegistration());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyStateRegistration()
    {
        $stateRegistration = '';

        $issuer = new Issuer;
        $issuer->setStateRegistration($stateRegistration);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testNullStateRegistration()
    {
        $stateRegistration = null;

        $issuer = new Issuer;
        $issuer->setStateRegistration($stateRegistration);
    }

    public function testIssuerAddress()
    {
        $address = new Address;

        $issuer = new Issuer;
        $issuer->setAddress($address);

        $this->assertInstanceOf('NfeFocus\Address', $issuer->getAddress());
    }


    public function testEmptyIssuerAddress()
    {
        try {
            $address = '';
            $issuer = new Issuer;
            $issuer->setAddress($address);
        } catch(\Exception $e) {
            $this->assertContains('must be an instance of NfeFocus\Address', $e->getMessage());
        }
    }
}