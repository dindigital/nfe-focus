#Nfe Focus - Emissão de Nota Fiscal Eletrônica
## Atualmente para empresas do simples nacional - SP
## Instalação - Composer (psr-4)
```json
{
  "require": {
    "dindigital/nfe-focus": "dev-master"
  }
}
```
### Definição de vendedor
```php
$issuer = new Issuer;
$issuer->setCompanyDocument('11112332000110'); // CNPJ
$issuer->setCompanyName('DIN DIGITAL WEB LTDA ME'); // Razão Social
$issuer->setTradingName('DIN DIGITAL'); // Nome Fantasia
$issuer->setStateRegistration('1234567890'); // Inscrição Estadual
```
### Definição do endereço do vendedor
```php
$issuerAddress = new Address;
$issuerAddress->setStreet('Rua Bernardino de Campos');
$issuerAddress->setNumber('31, Sala 501');
$issuerAddress->setNeighborhood('Centro');
$issuerAddress->setCity('Santo André');
$issuerAddress->setState('SP');
$issuerAddress->setZipCode('09015-010');

// Adiciono endereço do vendedor ao vendedor
$issuer->setAddress($issuerAddress);
```
### Definição de cliente
```php
$receiver = new Receiver;
$receiver->setDocument('446.441.646-23'); // CPF ou CNPJ
$receiver->setName('Mário Mello'); // Nome
$receiver->setEmail('mario@dindigital.com'); // E-mail
```
### Definição do endereço do cliente
```php
$receiverAddress = new Address;
$receiverAddress->setStreet('Rua Havana');
$receiverAddress->setNumber('217');
$receiverAddress->setNeighborhood('Parque das Américas');
$receiverAddress->setCity('Mauá');
$receiverAddress->setState('SP');
$receiverAddress->setZipCode('09351-020');

// Adiciono endereço do vendedor ao vendedor
$receiver->setAddress($receiverAddress);
```
### Definição de Produtos
```php
$product1 = new Item;
$product1->setDescription('Produto 1');
$product1->setQuantity('1');
$product1->setCost('300');
$product1->setNcmCode('33030020');

// Defino o container de produtos
$items = new ItemContainer($receiver);
$items->addItem($product1);
```
Para consulta do Código NCM [acesse](http://www4.receita.fazenda.gov.br/simulador/PesquisarNCM.jsp)
### Gerando nota fiscal
```php
$nfse = new Nfse(
    new DateTime("2015-03-23 12:00:00"), // data da venda
    $issuer, // vendedor
    $receiver, // cliente
    $items // container de produtos
);

$transaction = new InsertTransaction(Enviroment::DEVELOPMENT, 'token');
if ($transaction->insert($nfse, 'referencia')) { // OK
  //$transaction->getResponseBody();
} else { // erro
  //$transaction->getResponseBody();
}
```
### Consultando nota fiscal
```php
$transaction = new FindTransaction(Enviroment::DEVELOPMENT, 'token');
if ($transaction->find('referencia')) { // OK
  //$transaction->getResponseBody();
} else { // erro
  //$transaction->getResponseBody();
}
```
### Cancelando nota fiscal
```php
$transaction = new CancelTransaction(Enviroment::DEVELOPMENT, 'token');
$transaction->setJustification('Modtivo do cancelamento');
if ($transaction->cancel('referencia')) { // OK
  //$transaction->getResponseBody();
} else { // erro
  //$transaction->getResponseBody();
}
```

# Usando os exemplos
1. Renomeie o arquivo exemples/config.php.dist para config.php
2. Preencha com as informações de cadastro da FOCUS
3. Acesse o arquivo /exemples/insert.php e anote a **referencia**
4. Acesse o arquivo /exemples/find.php?ref=**referencia_do_insert**
5. Acesse o arquivo /exemples/cancel.php?ref=**referencia_do_insert**
