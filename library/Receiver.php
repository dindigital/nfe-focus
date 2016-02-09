<?php

namespace NfeFocus;

use NfeFocus\Address;
use NfeFocus\Exception\FieldRequiredException;
use Respect\Validation\Validator as v;

class Receiver {

    private $_document_cpf;
    private $_document_cnpj;
    private $_stateRegistration;
    private $_name;
    private $_address;
    private $_email;

    public function setDocument($value)
    {
        $document = null;

        if (v::cnpj()->validate($value))
            $document = $this->setCNPJ($value);

        if (v::cpf()->validate($value))
            $document = $this->setCPF($value);

        if (is_null($document))
            throw new FieldRequiredException("Documento é uma informação obrigatória");
    }

    private function setCPF($cpf)
    {
        $this->_document_cpf = preg_replace('/\D/', '', $cpf);
        return $this->_document_cpf;

    }

    private function setCNPJ($cnpj)
    {
        $this->_document_cnpj = preg_replace('/\D/', '', $cnpj);
        return $this->_document_cnpj;

    }

    public function getDocumentCPF()
    {
        return $this->_document_cpf;

    }


    public function getDocumentCNPJ()
    {
        return $this->_document_cnpj;

    }

    public function setStateRegistration($value)
    {
        if (v::string()->notEmpty()->validate($value)) {
            $value = preg_replace('/\D/', '', $value);
        } else {
            $value = 'ISENTO';
        }

        $this->_stateRegistration = $value;
    }

    public function getStateRegistration()
    {
        return $this->_stateRegistration;

    }

    public function setName($value)
    {
        if (!v::string()->notEmpty()->validate($value))
            throw new FieldRequiredException("Nome/Razão Social é uma informação obrigatória");

        $this->_name = $value;

    }

    public function getName()
    {
        return $this->_name;

    }

    public function setEmail($value)
    {
        if (!v::email()->validate($value))
            throw new FieldRequiredException("E-mail é uma informação obrigatória");

        $this->_email = $value;

    }

    public function getEmail()
    {
        return $this->_email;

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