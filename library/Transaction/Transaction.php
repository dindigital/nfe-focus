<?php

namespace NfeFocus\Transaction;

abstract class Transaction {

    protected $_server;
    protected $_token;
    protected $_responseBody;

    public function __construct($enviroment, $token)
    {
        switch ($enviroment) {
            case 1: // Desenvolvimento
                $this->_server = "http://homologacao.acrasnfe.acras.com.br";
                break;
            case 2: // Produção
                $this->_server = "http://producao.acrasnfe.acras.com.br";
                break;
            default:
               throw new \NfeFocus\Exception\InvalidEnviromentException("Ambiente inválido");
               break;
        }

        $this->_token = $token;

    }

    public function getResponseBody()
    {
        return $this->_responseBody;
    }

}