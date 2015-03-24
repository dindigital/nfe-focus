<?php

namespace NfeFocus\Items;

use NfeFocus\Receiver;

class ItemContainer {

    private $_items = array();
    private $_item_number = 1;
    private $_cfop;

    public function __construct(Receiver $receiver) {
        $uf = $receiver->getAddress()->getState();
        $this->_cfop = $uf == 'SP' ? '5102' : '6102';
    }

    public function addItem(Item $item)
    {
        $item->setItemNumber($this->_item_number);
        $item->setCfop($this->_cfop);
        $this->_items[] = $item;
        $this->_item_number++;
    }

    public function getItems()
    {
        $data = array();
        foreach ($this->_items as $key => $item) {
            $data[] = $item->getData();
        }
        return $data;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->_items as $key => $item) {
            $total += $item->getTotalCost();
        }
        return $total;
    }

}