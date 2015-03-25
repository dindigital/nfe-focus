<?php

namespace NfeFocus;

date_default_timezone_set('America/Sao_Paulo');

use NfeFocus\Issuer;
use NfeFocus\Receiver;
use NfeFocus\Address;
use NfeFocus\Items\Item;
use NfeFocus\Items\ItemContainer;
use DateTime;

class NfseTest extends \PHPUnit_Framework_TestCase
{

    public $issuer;
    public $receiver;
    public $items;

    public function __construct() {

        // Defino Vendedor
        $this->issuer = new Issuer;
        $this->issuer->setCompanyDocument('47.377.613/0001-06');
        $this->issuer->setCompanyName('DIN DIGITAL WEB LTDA ME');
        $this->issuer->setTradingName('DIN DIGITAL');
        $this->issuer->setStateRegistration('123.456.789-10');

        // Defino Endereço do Vendedor
        $issuerAddress = new Address;
        $issuerAddress->setStreet('Rua Bernardino de Campos');
        $issuerAddress->setNumber('31, Sala 501');
        $issuerAddress->setNeighborhood('Centro');
        $issuerAddress->setCity('Santo André');
        $issuerAddress->setState('SP');
        $issuerAddress->setZipCode('09015-010');

        // Adiciono endereço do vendedor ao vendedor
        $this->issuer->setAddress($issuerAddress);

        // Defino Cliente
        $this->receiver = new Receiver;
        $this->receiver->setDocument('446.441.646-23');
        $this->receiver->setName('NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL');
        $this->receiver->setEmail('mario@dindigital.com');

        // Defino Endereço do Vendedor
        $receiverAddress = new Address;
        $receiverAddress->setStreet('Rua Havana');
        $receiverAddress->setNumber('217');
        $receiverAddress->setNeighborhood('Parque das Américas');
        $receiverAddress->setCity('Mauá');
        $receiverAddress->setState('SP');
        $receiverAddress->setZipCode('09351-020');

        // Adiciono endereço do vendedor ao vendedor
        $this->receiver->setAddress($receiverAddress);

        // Crio um Produto
        $product1 = new Item;
        $product1->setDescription('Produto 1');
        $product1->setQuantity('1');
        $product1->setCost('300');
        $product1->setNcmCode('33030020');

        // Crio outro Produto
        $product2 = new Item;
        $product2->setDescription('Produto 2');
        $product2->setQuantity('2');
        $product2->setCost('125.50');
        $product2->setNcmCode('33030020');

        $this->items = new ItemContainer($this->receiver);
        $this->items->addItem($product1);
        $this->items->addItem($product2);

    }

    public function testNfse()
    {

        $nfse = new Nfse(
          new DateTime("2015-03-20 12:00:00"),
          $this->issuer,
          $this->receiver,
          $this->items
        );

        $mock = array(
          "natureza_operacao" => 'Remessa de Produtos',
          "forma_pagamento" => 0,
          "data_emissao" => '2015-03-20T12:00:00-03:00',
          "tipo_documento" => 1,
          "finalidade_emissao" => 1,
          "cnpj_emitente" => '47377613000106',
          "nome_emitente" => 'DIN DIGITAL WEB LTDA ME',
          "nome_fantasia_emitente" => 'DIN DIGITAL',
          "logradouro_emitente" => 'Rua Bernardino de Campos',
          "numero_emitente" => '31, Sala 501',
          "bairro_emitente" => 'Centro',
          "municipio_emitente" => 'Santo André',
          "uf_emitente" => 'SP',
          "cep_emitente" => '09015010',
          "telefone_emitente" => '',
          "inscricao_estadual_emitente" => '12345678910',
          "nome_destinatario" => 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL',
          "cnpj_destinatario" => '',
          "cpf_destinatario" => '44644164623',
          "inscricao_estadual_destinatario" => 'ISENTO',
          "telefone_destinatario" => '',
          "email_destinatario" => 'mario@dindigital.com',
          "logradouro_destinatario" => 'Rua Havana',
          "numero_destinatario" => '217',
          "bairro_destinatario" => 'Parque das Américas',
          "municipio_destinatario" => 'Mauá',
          "uf_destinatario" => 'SP',
          "pais_destinatario" => 'Brasil',
          "cep_destinatario" => '09351020',
          "icms_base_calculo" => '0',
          "icms_valor_total" => '0',
          "icms_base_calculo_st" => '0',
          "icms_valor_total_st" => '0',
          "icms_modalidade_base_calculo" => '0',
          "icms_valor" => '0',
          "valor_frete" => '0',
          "valor_seguro" => '0',
          "valor_total" => '551',
          "valor_produtos" => '551',
          "valor_ipi" => '0',
          "modalidade_frete" => '0',
          "informacoes_adicionais_contribuinte" => '',
          "items" => array(
            0 => array(
              "numero_item" => '1',
              "codigo_produto" => '5102',
              "descricao" => 'Produto 1',
              "cfop" => '5102',
              "unidade_comercial" => 'un',
              "quantidade_comercial" => '1',
              "valor_unitario_comercial" => '300',
              "valor_unitario_tributavel" => '300',
              "unidade_tributavel" => 'un',
              "codigo_ncm" => '33030020',
              "quantidade_tributavel" => '1',
              "valor_bruto" => '300',
              "icms_situacao_tributaria" => '103',
              "icms_origem" => '0',
              "pis_situacao_tributaria" => '99',
              "cofins_situacao_tributaria" => '99',
            ), 1 => array(
              "numero_item" => '2',
              "codigo_produto" => '5102',
              "descricao" => 'Produto 2',
              "cfop" => '5102',
              "unidade_comercial" => 'un',
              "quantidade_comercial" => '2',
              "valor_unitario_comercial" => '125.50',
              "valor_unitario_tributavel" => '125.50',
              "unidade_tributavel" => 'un',
              "codigo_ncm" => '33030020',
              "quantidade_tributavel" => '2',
              "valor_bruto" => '251',
              "icms_situacao_tributaria" => '103',
              "icms_origem" => '0',
              "pis_situacao_tributaria" => '99',
              "cofins_situacao_tributaria" => '99',
            )
          ),
        );

        $this->assertEquals($mock, $nfse->getNfse());

    }

}