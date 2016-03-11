<?php

namespace NfeFocus\Duplicatas;

class DuplicatasContainer {

    private $_duplicatas = array();

    public function addItem(Duplicata $duplicata)
    {
        $this->_duplicatas[] = $duplicata;
    }

    public function getDuplicatas()
    {
        $data = array();
        foreach ($this->_duplicatas as $key => $duplicata) {
            $data[] = $duplicata->getData();
        }
        return $data;
    }

    public function count()
    {
        return count($this->_duplicatas);
    }

}