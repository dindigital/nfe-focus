<?php

namespace NfeFocus;

class ReceiverTest extends \PHPUnit_Framework_TestCase
{

    public function testValidCompanyDocument()
    {
        $document = '47.377.613/0001-06';

        $receiver = new Receiver;
        $receiver->setDocument($document);

        $this->assertEquals('47377613000106', $receiver->getDocumentCNPJ());
    }

    public function testValidPeopleDocument()
    {
        $document = '446.441.646-23';

        $receiver = new Receiver;
        $receiver->setDocument($document);

        $this->assertEquals('44644164623', $receiver->getDocumentCPF());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testInvalidCompanyDocument()
    {
        $document = '47.377.613/0001-00';

        $receiver = new Receiver;
        $receiver->setDocument($document);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testInvalidPeopleDocument()
    {
        $document = '446.441.646-20';

        $receiver = new Receiver;
        $receiver->setDocument($document);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyDocument()
    {
        $document = '';

        $receiver = new Receiver;
        $receiver->setDocument($document);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testNullDocument()
    {
        $document = null;

        $receiver = new Receiver;
        $receiver->setDocument($document);
    }

    public function testValidName()
    {
        $name = 'Mário Mello';

        $receiver = new Receiver;
        $receiver->setName($name);

        $this->assertEquals($name, $receiver->getName());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyName()
    {
        $name = '';

        $receiver = new Receiver;
        $receiver->setName($name);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testNullName()
    {
        $name = null;

        $receiver = new Receiver;
        $receiver->setName($name);
    }


    public function testValidEmail()
    {
        $email = 'mario@dindigital.com';

        $receiver = new Receiver;
        $receiver->setEmail($email);

        $this->assertEquals($email, $receiver->getEmail());
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testInvalidEmail()
    {
        $email = 'mario mello';

        $receiver = new Receiver;
        $receiver->setEmail($email);
    }

    /**
     * @expectedException NfeFocus\Exception\FieldRequiredException
     */
    public function testEmptyEmail()
    {
        $email = '';

        $receiver = new Receiver;
        $receiver->setEmail($email);
    }

}