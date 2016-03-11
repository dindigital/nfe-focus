<?php

namespace NfeFocus\Duplicatas;

class Duplicata {

    private $_data = array(
        'numero' => '',
        'data_vencimento' => '',
        'valor' => '',
    );

    public function setNumber($number)
    {
        $this->_data['numero'] = $number;

    }

    public function setDate($date)
    {
        $this->_data['data_vencimento'] = $date;

    }

    public function setPrice($price)
    {
        $this->_data['valor'] = $price;

    }

    public function getData()
    {
        return $this->_data;
    }

}