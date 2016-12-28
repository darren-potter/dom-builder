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

class ATest extends DOMObject\Test\DOMObjectTest
{
    /**
     * @var DOMObject\HTML\AInterface $domObject A DOM Object for testing with.
     */
    protected $domObject;

    /**
     * @var string $objectName The name of the object.
     */
    protected $objectName = 'a';

    /**
     * Assert that the setHref() method sets the href attribute of the anchor tag.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\A::setHref();
     */
    public function setHref()
    {
        $href = 'my page';

        self::assertEquals($this->domObject, $this->domObject->setHref($href));
        self::assertArrayHasKey('href', $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals($href, $this->getPrivateProperty($this->domObject, 'attributes')['href']);
    }

    /**
     * Assert that the setTarget() method sets the target attribute of the anchor tag.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\HTML\A::setTarget();
     */
    public function setTarget()
    {
        $target = '_blank';

        self::assertEquals($this->domObject, $this->domObject->setTarget($target));
        self::assertArrayHasKey('target', $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals($target, $this->getPrivateProperty($this->domObject, 'attributes')['target']);
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
        return new HTML\A;
    }
}