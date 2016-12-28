<?php declare(strict_types = 1);

/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 19:53
 * @version 1.0
 */
namespace Devgorilla\DOMBuilder\DOMObject;

use InvalidArgumentException;

/**
 * Interface DOMObjectInterface
 * @package Devgorilla\DOMBuilder\DOMObject
 */
interface DOMObjectInterface
{
    /**
     * DOMObject constructor.
     *
     * @param string $name The name of the DOM Object.
     */
    public function __construct(string $name);

    /**
     * Set an attribute of the DOM Object.
     *
     * @param string $name The name of the attribute to set.
     * @param mixed $value The value of the attribute to set. If NULL is given, the attribute will be unset. To set a
     * blank attribute, you must set an empty string.
     *
     * @return $this
     */
    public function setAttribute(string $name, $value = '');

    /**
     * Unset an attribute from the DOM Object.
     *
     * This method will omit the desired attribute from being rendered, it will not allow for an attribute with a blank
     * value. To set an attribute with a blank value, you must use $domObject->setAttribute('attribute'); or
     * $domObject->setAttribute('attribute', '');
     *
     * @param string $name The name of the attribute to unset.
     *
     * @return $this
     */
    public function unsetAttribute(string $name);

    /**
     * Append a child DOM Object to this DOM Object.
     *
     * @param DOMObject|string $child The DOM Object to append to the current DOM Object.
     * @param int|null $position The position to set the child. If not set, the child will be appended to the end of
     * the current collection.
     *
     * @throws InvalidArgumentException If the given child is not a DOMObjectInterface or string.
     *
     * @return $this
     */
    public function appendChild($child, int $position = null);

    /**
     * Render the DOM Object as string.
     *
     * @return string.
     */
    public function __toString();
}