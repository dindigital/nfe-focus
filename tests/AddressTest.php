<?php

namespace NfeFocus;

class AddressTest extends \PHPUnit_Framework_TestCase
{

    public function testValidaStreet()
    {
        $street = 'Nome da Rua';

        $address = new Address;
        $address->setStreet($street);

        $this->assertEquals($street, $address->getStreet());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyStreet()
    {
        $street = '';

        $address = new Address;
        $address->setStreet($street);
    }

    public function testValidaNumber()
    {
        $number = '217';

        $address = new Address;
        $address->setNumber($number);

        $this->assertEquals($number, $address->getNumber());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyNumber()
    {
        $number = '';

        $address = new Address;
        $address->setNumber($number);
    }

    public function testValidNeighborhood()
    {
        $neighborhood = 'Nome do Bairro';

        $address = new Address;
        $address->setNeighborhood($neighborhood);

        $this->assertEquals($neighborhood, $address->getNeighborhood());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyNeighborhood()
    {
        $neighborhood = '';

        $address = new Address;
        $address->setNeighborhood($neighborhood);
    }

    public function testValidaCity()
    {
        $city = 'Nome da Cidade';

        $address = new Address;
        $address->setCity($city);

        $this->assertEquals($city, $address->getCity());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyCity()
    {
        $city = '';

        $address = new Address;
        $address->setCity($city);
    }

    public function testValidaState()
    {
        $state = 'SP';

        $address = new Address;
        $address->setState($state);

        $this->assertEquals($state, $address->getState());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyState()
    {
        $state = '';

        $address = new Address;
        $address->setState($state);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testInvalidState()
    {
        $state = 'São Paulo';

        $address = new Address;
        $address->setState($state);
    }

    public function testValidaZipCode()
    {
        $zipcode = '09351-020';

        $address = new Address;
        $address->setZipCode($zipcode);

        $this->assertEquals('09351020', $address->getZipCode());
    }

    public function testValidaZipCodeWithoutDash()
    {
        $zipcode = '09351020';

        $address = new Address;
        $address->setZipCode($zipcode);

        $this->assertEquals($zipcode, $address->getZipCode());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyZipCode()
    {
        $zipcode = '';

        $address = new Address;
        $address->setZipCode($zipcode);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testInvalidZipCode()
    {
        $zipcode = '0000000';

        $address = new Address;
        $address->setZipCode($zipcode);
    }

}