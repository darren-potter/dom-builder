<?php declare(strict_types = 1);

/**
 * @author Darren Potter <darren.potter@outlook.com>
 * @created 28/12/2016 19:07
 * @version 0.1
 * @package Devgorilla\DOMBuilder\DOMObject
 */
namespace Devgorilla\DOMBuilder\DOMObject;

use InvalidArgumentException;

/**
 * Class DOMObject
 * @package Devgorilla\DOMBuilder\DOMObject
 */
class DOMObject implements DOMObjectInterface
{
    /**
     * @var string $name The name of the DOM Object.
     */
    protected $name;

    /**
     * @var string[] $attributes A collection of attributes and their values.
     */
    protected $attributes = [];

    /**
     * @var DOMObject[] $children A collection of child objects.
     */
    protected $children = [];

    /**
     * DOMObject constructor.
     *
     * @param string $name The name of the DOM Object.
     */
    public function __construct(string $name)
    {
        $this->name = strtolower($name);
    }

    /**
     * Set an attribute of the DOM Object.
     *
     * @param string $name The name of the attribute to set.
     * @param mixed $value The value of the attribute to set. If null is given, the attribute will be unset. To set a
     * blank attribute, you must set an empty string.
     *
     * @return $this
     */
    public function setAttribute(string $name, $value = '')
    {
        if ($value === null) {
            $this->unsetAttribute($name);
        } else {
            $this->attributes[$name] = $value;
        }

        return $this;
    }

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
    public function unsetAttribute(string $name)
    {
        $this->attributes[$name] = null;
        unset($this->attributes[$name]);

        return $this;
    }

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
    public function appendChild($child, int $position = null)
    {
        if (!is_string($child) && ! $child instanceof DOMObjectInterface) {
            throw new InvalidArgumentException('The child to append must be of type DOMObjectInterface or string.');
        }

        if (is_int($position) && array_key_exists($position, $this->children)) {
            $this->freePositionInChildren($position);
            $this->children[$position] = $child;
        } else {
            $this->children[] = $child;
        }

        ksort($this->children);

        return $this;
    }

    /**
     * Shift the positions of children in order to make the given position available.
     *
     * @param int $position The position to free up.
     *
     * @return void.
     */
    private function freePositionInChildren(int $position)
    {
        ksort($this->children);
        $children = array_reverse(array_slice($this->children, $position, null, true), true);
        array_walk($children, function ($domObject, int $key) {
            $this->children[$key + 1] = $domObject;
        });
    }

    /**
     * Render the DOM Object as string.
     *
     * @return string.
     */
    public function __toString()
    {
        $domString = '<' . $this->name . ' ';

        foreach ($this->attributes as $attribute => $value) {
            $domString .= $attribute;
            if ($value !== '') {
                $domString .= '="' . htmlspecialchars($value) . '"';
            }
            $domString .= ' ';
        }

        if (count($this->children) > 0) {
            $domString .= '>';
            foreach ($this->children as $child) {
                $domString .= (string) $child;
            }
            $domString .= '</' . $this->name;
        } else {
            $domString .= '/';
        }

        $domString .= '>';

        return $domString;
    }
}
