<?php  declare(strict_types = 1);

/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 22:16
 * @version 1.0
 * @package Devgorilla\DOMBuilder\DOMObject\HTML
 */

namespace Devgorilla\DOMBuilder\DOMObject\HTML;

use Devgorilla\DOMBuilder\DOMObject;

class Body extends DOMObject\DOMObject implements BodyInterface
{
    /**
     * Construct a HTML anchor DOM Object.
     */
    public function __construct()
    {
        parent::__construct('body');
    }
}
