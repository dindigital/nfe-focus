<?php

namespace NfeFocus;

date_default_timezone_set('America/Sao_Paulo');
use DateTime;

class Nfse {

    private $_nfse;

    public function __construct( DateTime $datetime,
                                 Issuer $issuer,
                                 Receiver $receiver,
                                 Items\ItemContainer $items,
                                 Duplicatas\DuplicatasContainer $duplicatas = null
                                ) {

        $this->_nfse = array(
          "natureza_operacao" => 'Remessa de Produtos',
          "forma_pagamento" => 0,
          "data_emissao" => $datetime->format(DateTime::ATOM),
          "tipo_documento" => 1,
          "finalidade_emissao" => 1,
          "cnpj_emitente" => $issuer->getCompanyDocument(),
          "nome_emitente" => $issuer->getCompanyName(),
          "nome_fantasia_emitente" => $issuer->getTradingName(),
          "logradouro_emitente" => $issuer->getAddress()->getStreet(),
          "numero_emitente" => $issuer->getAddress()->getNumber(),
          "bairro_emitente" => $issuer->getAddress()->getNeighborhood(),
          "municipio_emitente" => $issuer->getAddress()->getCity(),
          "uf_emitente" => $issuer->getAddress()->getState(),
          "cep_emitente" => $issuer->getAddress()->getZipCode(),
          "telefone_emitente" => '',
          "inscricao_estadual_emitente" => $issuer->getStateRegistration(),
          "nome_destinatario" => $receiver->getName(),
          "cnpj_destinatario" => $receiver->getDocumentCNPJ(),
          "cpf_destinatario" => $receiver->getDocumentCPF(),
          "inscricao_estadual_destinatario" => $receiver->getStateRegistration(),
          "telefone_destinatario" => '',
          "email_destinatario" => $receiver->getEmail(),
          "logradouro_destinatario" => $receiver->getAddress()->getStreet(),
          "numero_destinatario" => $receiver->getAddress()->getNumber(),
          "bairro_destinatario" => $receiver->getAddress()->getNeighborhood(),
          "municipio_destinatario" => $receiver->getAddress()->getCity(),
          "uf_destinatario" => $receiver->getAddress()->getState(),
          "pais_destinatario" => 'Brasil',
          "cep_destinatario" => $receiver->getAddress()->getZipCode(),
          "icms_base_calculo" => '0',
          "icms_valor_total" => '0',
          "icms_base_calculo_st" => '0',
          "icms_valor_total_st" => '0',
          "icms_modalidade_base_calculo" => '0',
          "icms_valor" => '0',
          "valor_frete" => '0',
          "valor_seguro" => '0',
          "valor_total" => $items->getTotal(),
          "valor_produtos" => $items->getTotal(),
          "valor_ipi" => '0',
          "modalidade_frete" => '0',
          "informacoes_adicionais_contribuinte" => '',
          "items" => $items->getItems()
        );

        if (!is_null($duplicatas) && $duplicatas->count()) {
            $this->_nfse['duplicatas'] = $duplicatas->getDuplicatas();
        }

    }

    public function setNatureOperations($title)
    {
        $this->_nfse['natureza_operacao'] = substr($title,0,60);
    }

    /**
     * @param $option
     *  - 0 a vista
     *  - 1 a prazo
     *  - 2 outros
     */
    public function setPayment($option)
    {
        $this->_nfse['forma_pagamento'] = $option;
    }

    /**
     * @param $option
     *  - 1 Nota normal
     *  - 2 Nota complementar
     *  - 3 Nota de ajuste
     *  - 4 Devolução de mercadoria
     */
    public function setOrderIssue($option)
    {
        $this->_nfse['finalidade_emissao'] = $option;
    }

    public function setInformation($text)
    {
        $this->_nfse['informacoes_adicionais_contribuinte'] = $text;

    }

    public function setSerie($serie)
    {
        $this->_nfse['serie'] = $serie;
    }

    public function setNumero($numero)
    {
        $this->_nfse['numero'] = $numero;
    }

    /**
     * @param $shipping_mode
     *  - 0: por conta do emitente
     *  - 1: por conta do destinatário
     *  - 2: por conta de terceiros
     *  - 9: sem frete
     */
    public function setShippingMode($shipping_mode)
    {
        $this->_nfse['modalidade_frete'] = $shipping_mode;
    }

    public function getNfse()
    {
        return $this->_nfse;
    }

}