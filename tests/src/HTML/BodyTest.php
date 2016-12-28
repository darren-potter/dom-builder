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

class BodyTest extends DOMObject\Test\DOMObjectTest
{
    /**
     * @var DOMObject\HTML\BodyInterface $domObject A DOM Object for testing with.
     */
    protected $domObject;

    /**
     * @var string $objectName The name of the object.
     */
    protected $objectName = 'body';

    /**
     * Get a DOM Object of the given name.
     *
     * @param string $name The name of the object to get.
     *
     * @return DOMObject\DOMObject
     */
    protected function getDOMObject(string $name)
    {
        return new HTML\Body;
    }
}