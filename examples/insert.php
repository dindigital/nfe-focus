<?php

require '../vendor/autoload.php';
require 'config.php';

use NfeFocus\Nfse;
use NfeFocus\Enviroment;
use NfeFocus\Issuer;
use NfeFocus\Receiver;
use NfeFocus\Address;
use NfeFocus\Items\Item;
use NfeFocus\Items\ItemContainer;
use NfeFocus\Transaction\InsertTransaction;


try {
    $issuer = new Issuer;
    $issuer->setCompanyDocument(CNPJ);
    $issuer->setCompanyName('DIN DIGITAL WEB LTDA ME');
    $issuer->setTradingName('DIN DIGITAL');
    $issuer->setStateRegistration(IE);

    $issuerAddress = new Address;
    $issuerAddress->setStreet('Rua Bernardino de Campos');
    $issuerAddress->setNumber('31, Sala 501');
    $issuerAddress->setNeighborhood('Centro');
    $issuerAddress->setCity('Santo André');
    $issuerAddress->setState('SP');
    $issuerAddress->setZipCode('09015-010');

    $issuer->setAddress($issuerAddress);

    $receiver = new Receiver;
    $receiver->setDocument('446.441.646-23');
    $receiver->setName('NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL');
    $receiver->setEmail('mario@dindigital.com');

    $receiverAddress = new Address;
    $receiverAddress->setStreet('Rua Bernardino de Campos');
    $receiverAddress->setNumber('31, Sala 501');
    $receiverAddress->setNeighborhood('Centro');
    $receiverAddress->setCity('Santo André');
    $receiverAddress->setState('SP');
    $receiverAddress->setZipCode('09015-010');

    $receiver->setAddress($receiverAddress);

    $product1 = new Item;
    $product1->setDescription('Produto 1');
    $product1->setQuantity('1');
    $product1->setCost('300');
    $product1->setNcmCode('33030020');

    $items = new ItemContainer($receiver);
    $items->addItem($product1);

    $nfse = new Nfse(
        new DateTime("2015-03-23 12:00:00"),
        $issuer,
        $receiver,
        $items
    );
} catch (\NfeFocus\Exception\FieldRequiredException $e) {
    die($e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}

$reference = uniqid();
echo "Referencia: {$reference}<br/>";

$transaction = new InsertTransaction(Enviroment::DEVELOPMENT, TOKEN);
if ($transaction->insert($nfse, $reference)) {
  echo "OK";
  // Persistir a referencia utilizada para emissão da nota fiscal
} else {
  echo "ERROR";
  // Persistir a resposta do servidor $transaction->getResponseBody()
  //echo $transaction->getResponseBody();
}