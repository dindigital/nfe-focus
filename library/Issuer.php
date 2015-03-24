<?php

namespace NfeFocus;

use NfeFocus\Address;
use NfeFocus\Exception\FieldRequiredException;
use Respect\Validation\Validator as v;

class Issuer {

    private $_companyDocument;
    private $_companyName;
    private $_tradingName;
    private $_stateRegistration;

    public function setCompanyDocument($value)
    {
        if (!v::cnpj()->validate($value))
            throw new FieldRequiredException("CNPJ é uma informação obrigatória");

        $cnpj = preg_replace('/\D/', '', $value);

        $this->_companyDocument = $cnpj;
    }

    public function getCompanyDocument()
    {
        return $this->_companyDocument;

    }

    public function setCompanyName($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Razão Social é uma informação obrigatória");

        $this->_companyName = $value;

    }

    public function getCompanyName()
    {
        return $this->_companyName;

    }

    public function setTradingName($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Nome Fantasia é uma informação obrigatória");

        $this->_tradingName = $value;

    }

    public function getTradingName()
    {
        return $this->_tradingName;

    }

    public function setStateRegistration($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Inscrição Estadual é uma informação obrigatória");

        $value = preg_replace('/\D/', '', $value);

        $this->_stateRegistration = $value;

    }

    public function getStateRegistration()
    {
        return $this->_stateRegistration;

    }

    public function setAddress(Address $address)
    {
        $this->_address = $address;
    }

    public function getAddress()
    {
        return $this->_address;
    }

}