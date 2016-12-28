<?php declare(strict_types = 1);

/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 22:17
 * @version 1.0
 */
namespace Devgorilla\DOMBuilder\DOMObject\HTML;

use Devgorilla\DOMBuilder\DOMObject;

interface ButtonInterface extends DOMObject\DOMObjectInterface
{
    /**
     * Set the form name the button belongs to.
     *
     * @param string $form The name of the form.
     *
     * @return $this
     */
    public function setForm(string $form);

    /**
     * Set the disabled state of the button.
     *
     * @param bool $disabled The disabled state of the button.
     *
     * @return $this
     */
    public function setDisabled(bool $disabled);

    /**
     * Set the name of the button.
     *
     * @param string $name The name of the button.
     *
     * @return $this
     */
    public function setName(string $name);

    /**
     * Set the Id of the button.
     *
     * @param string $id The Id of the button.
     *
     * @return $this
     */
    public function setId(string $id);
}
