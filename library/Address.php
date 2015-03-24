<?php

namespace NfeFocus;

use NfeFocus\Exception\FieldRequiredException;
use Respect\Validation\Validator as v;

class Address {

    private $_street;
    private $_number;
    private $_neighborhood;
    private $_city;
    private $_state;
    private $_zipcode;
    private $_country = 'Brasil';

    public function setStreet($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Logradouro é uma informação obrigatória");

        $this->_street = $value;

    }

    public function getStreet()
    {
        return $this->_street;

    }

    public function setNumber($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Número é uma informação obrigatória");

        $this->_number = $value;

    }

    public function getNumber()
    {
        return $this->_number;

    }

    public function setNeighborhood($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Bairro é uma informação obrigatória");

        $this->_neighborhood = $value;

    }

    public function getNeighborhood()
    {
        return $this->_neighborhood;

    }

    public function setCity($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Cidade é uma informação obrigatória");

        $this->_city = $value;

    }

    public function getCity()
    {
        return $this->_city;

    }

    public function setState($value)
    {
        if (!v::string()->notEmpty()->validate($value) || strlen($value) != 2)
            throw new FieldRequiredException("Estado é uma informação obrigatória");

        $this->_state = strtoupper($value);

    }

    public function getState()
    {
        return $this->_state;

    }

    public function setZipCode($value)
    {
        $value = str_replace('-','',$value);
        if (!v::numeric()->postalCode('BR')->validate($value))
            throw new FieldRequiredException("CEP é uma informação obrigatória");

        $this->_zipcode = $value;

    }

    public function getZipCode()
    {
        return $this->_zipcode;

    }

}