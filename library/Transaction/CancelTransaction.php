<?php

namespace NfeFocus\Transaction;

use Zend\Http\Client;
use Respect\Validation\Validator as v;
use NfeFocus\Exception\FieldRequiredException;

class CancelTransaction extends Transaction {

    private $_justification;

    public function setJustification($justification)
    {
        if (!v::string()->length(15, 1000)->validate($justification))
            throw new FieldRequiredException("A justicativa deve ter entre 15 e 100 caracteres");

        $this->_justification = $justification;
    }

    public function cancel($reference)
    {
        $url = $this->_server . "/nfe2/cancelar/";
        $client = new Client($url);
        $client->setMethod('GET');
        $client->setParameterGet(array(
           'token'  => $this->_token,
           'ref' => $reference,
           'justificativa' => $this->_justification
        ));

        $response = $client->send();

        $this->_responseBody = $response->getBody();

        return $response->isSuccess();

    }

}