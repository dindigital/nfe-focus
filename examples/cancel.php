<?php

require '../vendor/autoload.php';
require 'config.php';

use NfeFocus\Enviroment;
use NfeFocus\Transaction\CancelTransaction;

$reference = $_GET['ref'];

try {
    $transaction = new CancelTransaction(Enviroment::DEVELOPMENT, TOKEN);
    $transaction->setJustification('Nota de Teste. Motivo de exemplo para cancelamento.');
} catch (\NfeFocus\Exception\FieldRequiredException $e) {
    die($e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}

if ($transaction->cancel($reference)) {
  echo "OK<br>/";
  // Persistir resposta do servidor: $transaction->getResponseBody();
  echo $transaction->getResponseBody() . "<br />";

} else {
  echo "ERROR" . "<br />";
  // Persistir resposta do servidor: $transaction->getResponseBody();
  echo $transaction->getResponseBody() . "<br />";
}