<?php declare(strict_types = 1);

/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 22:29
 * @version 1.0
 * @package Devgorilla\DOMBuilder\DOMObject\HTML
 */

namespace Devgorilla\DOMBuilder\DOMObject\HTML;

use Devgorilla\DOMBuilder\DOMObject\DOMObject;

class Button extends DOMObject implements ButtonInterface
{
    /**
     * Button constructor.
     */
    public function __construct()
    {
        parent::__construct('button');
    }

    /**
     * Set the form name the button belongs to.
     *
     * @param string $form The name of the form.
     *
     * @return $this
     */
    public function setForm(string $form)
    {
        return $this->setAttribute('form', $form);
    }

    /**
     * Set the disabled state of the button.
     *
     * @param bool $disabled The disabled state of the button.
     *
     * @return $this
     */
    public function setDisabled(bool $disabled)
    {
        if ($disabled) {
            return $this->setAttribute('disabled', 'disabled');
        }

        $this->unsetAttribute('disabled');
        return $this;
    }

    /**
     * Set the name of the button.
     *
     * @param string $name The name of the button.
     *
     * @return $this
     */
    public function setName(string $name)
    {
        return $this->setAttribute('name', $name);
    }

    /**
     * Set the Id of the button.
     *
     * @param string $id The Id of the button.
     *
     * @return $this
     */
    public function setId(string $id)
    {
        return $this->setAttribute('id', $id);
    }
}