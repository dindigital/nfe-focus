<?php

namespace NfeFocus\Transaction;

use Zend\Http\Client;
use Symfony\Component\Yaml\Parser;

class FindTransaction extends Transaction {

    private $_data;

    public function find($reference)
    {
        $url = $this->_server . "/nfe2/consultar/?token={$this->_token}&ref={$reference}";
        $client = new Client($url);
        $client->setMethod('GET');

        $response = $client->send();
        $this->_responseBody = $response->getBody();

        $yaml = new Parser;
        $this->_data = $yaml->parse($this->_responseBody);

        return $response->isSuccess();
    }

    public function getStatus()
    {
        return $this->_data['status'];
    }

    public function getData()
    {
        return $this->_data;
    }

}