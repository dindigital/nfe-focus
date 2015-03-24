<?php

namespace NfeFocus\Transaction;

use NfeFocus\Nfse;
use Zend\Http\Client;
use Symfony\Component\Yaml\Dumper;

class InsertTransaction extends Transaction {


    public function insert(Nfse $nfse, $reference)
    {
        $url = $this->_server . "/nfe2/autorizar/?token={$this->_token}&ref={$reference}";
        $client = new Client($url);
        $client->setMethod('POST');

        $dumper = new Dumper();
        $yaml = $dumper->dump($nfse->getNfse());
        $client->setRawBody($yaml);

        $response = $client->send();

        $this->_responseBody = $response->getBody();

        return $response->isSuccess();
    }

}