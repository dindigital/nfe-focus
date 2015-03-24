<?php

require '../vendor/autoload.php';
require 'config.php';

use NfeFocus\Enviroment;
use NfeFocus\Transaction\FindTransaction;

$reference = $_GET['ref'];

$transaction = new FindTransaction(Enviroment::DEVELOPMENT, TOKEN);
if ($transaction->find($reference)) {
  echo "OK<br>/";
  // Persistir resposta do servidor: $transaction->getResponseBody();
  echo $transaction->getResponseBody() . "<br />";
  echo $transaction->getStatus() . "<br />";

} else {
  echo "ERROR" . "<br />";
  // Persistir resposta do servidor: $transaction->getResponseBody();
  echo $transaction->getResponseBody() . "<br />";
}