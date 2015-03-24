<?php

namespace NfeFocus\Items;

class Item {

    private $_data = array(
        'numero_item' => '1',
        'codigo_produto' => '6949',
        'descricao' => '',
        'cfop' => '5102', //5102 - 6102
        'unidade_comercial' => 'un',
        'quantidade_comercial' => '1',
        'valor_unitario_comercial' => '0',
        'valor_unitario_tributavel' => '0',
        'unidade_tributavel' => 'un',
        'codigo_ncm' => '',
        'quantidade_tributavel' => '1',
        'valor_bruto' => '0',
        'icms_situacao_tributaria' => '103',
        'icms_origem' => '0',
        'pis_situacao_tributaria' => '99',
        'cofins_situacao_tributaria' => '99',
    );

    public function setItemNumber($number)
    {
        $this->_data['numero_item'] = $number;

    }

    public function setDescription($description)
    {
        $this->_data['descricao'] = $description;

    }

    public function setCfop($cfop)
    {
        $this->_data['cfop'] = $cfop;
        $this->_data['codigo_produto'] = $cfop;

    }

    public function setNcmCode($ncm)
    {
        $this->_data['codigo_ncm'] = $ncm;

    }

    public function setQuantity($quantity)
    {
        $this->_data['quantidade_tributavel'] = $quantity;
        $this->_data['quantidade_comercial'] = $quantity;

    }

    public function setCost($price)
    {
        $this->_data['valor_unitario_comercial'] = $price;
        $this->_data['valor_unitario_tributavel'] = $price;
        $this->_data['valor_bruto'] = $price * $this->_data['quantidade_comercial'];
    }

    public function getTotalCost()
    {
        return $this->_data['valor_bruto'];
    }

    public function getData()
    {
        return $this->_data;
    }

}