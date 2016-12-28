<?php
/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 22:05
 * @version 1.0
 * @package Devgorilla\DOMBuilder\DOMObject\HTML\Tests
 */


namespace Devgorilla\DOMBuilder\DOMObject\HTML\Test;

use Devgorilla\DOMBuilder\DOMObject;
use Devgorilla\DOMBuilder\DOMObject\HTML;

class ButtonTest extends DOMObject\Test\DOMObjectTest
{
    /**
     * @var DOMObject\HTML\ButtonInterface $domObject A DOM Object for testing with.
     */
    protected $domObject;

    /**
     * @var string $objectName The name of the object.
     */
    protected $objectName = 'button';

    /**
     * Assert that the setForm() method sets name of the form the button belongs to.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\Button::setForm();
     */
    public function setForm()
    {
        $form = 'myForm';

        self::assertEquals($this->domObject, $this->domObject->setForm($form));
        self::assertArrayHasKey('form', $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals($form, $this->getPrivateProperty($this->domObject, 'attributes')['form']);
    }

    /**
     * Assert that the setName() method sets the name of the button.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\Button::setName();
     */
    public function setButtonName()
    {
        $name = 'myButton';

        self::assertEquals($this->domObject, $this->domObject->setName($name));
        self::assertArrayHasKey('name', $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals($name, $this->getPrivateProperty($this->domObject, 'attributes')['name']);
    }

    /**
     * Assert that the setId() method sets the Id of the button.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\Button::setId();
     */
    public function setId()
    {
        $id = 'myButton';

        self::assertEquals($this->domObject, $this->domObject->setId($id));
        self::assertArrayHasKey('id', $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals($id, $this->getPrivateProperty($this->domObject, 'attributes')['id']);
    }

    /**
     * Assert that the setDisabled() method can disable the button.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\Button::setDisabled();
     */
    public function disableButton()
    {
        self::assertEquals($this->domObject, $this->domObject->setDisabled(true));
        self::assertArrayHasKey('disabled', $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals('disabled', $this->getPrivateProperty($this->domObject, 'attributes')['disabled']);

        return $this->domObject;
    }

    /**
     * Assert that the setDisabled() method can disable the button.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\Button::setDisabled();
     *
     * @depends disableButton
     * @param HTML\ButtonInterface $disabledButton A disabled button.
     */
    public function enableButton(HTML\ButtonInterface $disabledButton)
    {
        self::assertArrayHasKey('disabled', $this->getPrivateProperty($disabledButton, 'attributes'));
        self::assertEquals($disabledButton, $disabledButton->setDisabled(false));
        self::assertArrayNotHasKey('disabled', $this->getPrivateProperty($disabledButton, 'attributes'));
    }

    /**
     * Get a DOM Object of the given name.
     *
     * @param string $name The name of the object to get.
     *
     * @return DOMObject\DOMObject
     */
    protected function getDOMObject(string $name)
    {
        return new HTML\Button;
    }
}