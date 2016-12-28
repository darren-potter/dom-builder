<?php declare(strict_types = 1);

/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 20:07
 * @version 1.0
 * @package Devgorilla\DOMBuilder\DOMObject\Test
 */

namespace Devgorilla\DOMBuilder\DOMObject\Test;

use Devgorilla\DOMBuilder\DOMObject;
use PHPUnit_Framework_TestCase;
use ReflectionClass;


class DOMObjectTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DOMObject\DOMObjectInterface $domObject A DOM Object for testing with.
     */
    protected $domObject;

    /**
     * @var string $objectName The name of the object.
     */
    protected $objectName = 'a';

    /**
     * Set up the environment for testing with.
     *
     * @before
     */
    public function setUp()
    {
        $this->domObject = $this->getDOMObject($this->objectName);
    }

    /**
     * Assert that the DOM Object has been built correctly.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::__construct();
     */
    public function DOMObject()
    {
        self::assertInstanceOf(DOMObject\DOMObjectInterface::class, $this->domObject);
        self::assertEquals($this->objectName, $this->getPrivateProperty($this->domObject, 'name'));
    }

    /**
     * Assert that the setAttribute() method adds attributes to the attributes collection.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::setAttribute();
     *
     * @return string The name of the attribute set for further testing.
     */
    public function setAttribute()
    {
        $attributeName = 'my-attribute';
        $attributeValue = 'some value';

        self::assertEquals($this->domObject, $this->domObject->setAttribute($attributeName, $attributeValue));
        self::assertArrayHasKey($attributeName, $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals($attributeValue, $this->getPrivateProperty($this->domObject, 'attributes')[$attributeName]);

        return $attributeName;
    }

    /**
     * Assert that the setAttribute() method default a blank attribute to the collection.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::setAttribute();
     */
    public function setDefaultBlankAttribute()
    {
        $attributeName = 'my-blank-attribute';

        self::assertEquals($this->domObject, $this->domObject->setAttribute($attributeName));
        self::assertArrayHasKey($attributeName, $this->getPrivateProperty($this->domObject, 'attributes'));
        self::assertEquals('', $this->getPrivateProperty($this->domObject, 'attributes')[$attributeName]);
    }

    /**
     * Assert that when we set a null attribute value, we actually unset the attribute.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::setAttribute();
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::unsetAttribute();
     */
    public function setNullAttributeUnsetsAttribute()
    {
        $attributeName = 'my-attribute';
        $this->domObject->setAttribute($attributeName);

        $this->domObject->setAttribute($attributeName, null);
        self::assertArrayNotHasKey($attributeName, $this->getPrivateProperty($this->domObject, 'attributes'));
    }

    /**
     * Assert that when we set a unset an attribute, the attribute no longer exists.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::unsetAttribute();
     */
    public function unsetAttribute()
    {
        $attributeName = 'my-attribute';
        $this->domObject->setAttribute($attributeName);

        $this->domObject->unsetAttribute($attributeName);
        self::assertArrayNotHasKey($attributeName, $this->getPrivateProperty($this->domObject, 'attributes'));
    }

    /**
     * Assert that we can add DOM Objects and string to the children collection.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::appendChild();
     */
    public function appendChild()
    {
        $child = $this->getDOMObject('b');
        self::assertEquals($this->domObject, $this->domObject->appendChild($child));
        self::assertContains($child, $this->getPrivateProperty($this->domObject, 'children'));

        $string = 'Some stringy stuff.';
        self::assertEquals($this->domObject, $this->domObject->appendChild($string));
        self::assertContains($string, $this->getPrivateProperty($this->domObject, 'children'));

    }

    /**
     * Assert that you can append children to specific positions.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::appendChild();
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::freePositionInChildren();
     */
    public function appendChildToPosition()
    {
        $child1 = 'string 1';
        $child2 = 'string 2';
        $child3 = 'string 3';
        $child4 = 'string 4';
        $child5 = 'string 5';

        $this->domObject
            ->appendChild($child1)
            ->appendChild($child2)
            ->appendChild($child3)
            ->appendChild($child4)
            ->appendChild($child5);

        // Make sure the collection is clean before appending child to position.
        $position = 2;
        $childBefore3 = 'string 2.5';
        self::assertCount(5, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertArrayHasKey($position, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertNotEquals($childBefore3, $this->getPrivateProperty($this->domObject, 'children')[$position]);

        // Append child to position and make sure the collection is as expected.
        $this->domObject->appendChild($childBefore3, $position);
        self::assertCount(6, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertArrayHasKey($position, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertEquals($childBefore3, $this->getPrivateProperty($this->domObject, 'children')[$position]);
    }

    /**
     * Assert that you cannot append children to impossible positions.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::appendChild();
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::freePositionInChildren();
     */
    public function appendChildToImpossiblePosition()
    {
        $child1 = 'string 1';
        $child2 = 'string 2';
        $child3 = 'string 3';
        $child4 = 'string 4';
        $child5 = 'string 5';

        $this->domObject
            ->appendChild($child1)
            ->appendChild($child2)
            ->appendChild($child3)
            ->appendChild($child4)
            ->appendChild($child5);


        // Make sure the collection is clean before appending a child to an impossible position.
        $position = 10;
        $childAfter5 = 'string 6';
        self::assertCount(5, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertArrayNotHasKey($position, $this->getPrivateProperty($this->domObject, 'children'));

        // Append child to position and make sure the collection is as expected.
        $this->domObject->appendChild($childAfter5, $position);
        self::assertCount(6, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertArrayNotHasKey($position, $this->getPrivateProperty($this->domObject, 'children'));
        self::assertContains($childAfter5, $this->getPrivateProperty($this->domObject, 'children'));
    }

    /**
     * Assert an InvalidArgumentException is thrown when we attempt to append invalid invalid child values.
     *
     * @dataProvider invalidChildTypes
     * @param mixed $child Invalid child values.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::appendChild();
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The child to append must be of type DOMObjectInterface or string.
     */
    public function appendInvalidChild($child)
    {
        $this->domObject->appendChild($child);
    }

    /**
     * Assert the DOM Object will output as expected.
     *
     * @test
     * @covers \Devgorilla\DOMBuilder\DOMObject\DOMObject::__toString();
     */
    public function output()
    {
        $attributeName = 'my-attribute';
        $attributeValue = 'some value';
        $child = 'innerHTML';
        $expectedOutput = '<' . $this->objectName . ' ';
        $expectedOutput .= $attributeName . '="' . $attributeValue . '" >';
        $expectedOutput .= $child;
        $expectedOutput .= '</' . $this->objectName . '>';

        $this->domObject->setAttribute($attributeName, $attributeValue);
        $this->domObject->appendChild($child);

        self::assertEquals($expectedOutput, (string) $this->domObject);
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
        return new DOMObject\DOMObject($name);
    }

    /**
     * Get the value of a private property of a DOM Object.
     *
     * @param DOMObject\DOMObjectInterface $domObject The DOM Object to get the property value from.
     * @param string $property The name of the property.
     *
     * @return mixed.
     */
    protected function getPrivateProperty(DOMObject\DOMObjectInterface $domObject, string $property)
    {
        $reflectionClass = new ReflectionClass($domObject);
        $reflectionProperty = $reflectionClass->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($domObject);
    }

    /**
     * @return mixed[] A collection of scalar types that are not valid children.
     */
    public static function invalidChildTypes()
    {
        return [
            [123],
            [1.23],
            [false],
            [null]
        ];
    }
}
