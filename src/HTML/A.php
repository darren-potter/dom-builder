<?php declare(strict_types = 1);
/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 21:31
 * @version 1.0
 * @package Devgorilla\DOMBuilder\DOMObject\HTML
 */

namespace Devgorilla\DOMBuilder\DOMObject\HTML;

use Devgorilla\DOMBuilder\DOMObject;

class A extends DOMObject\DOMObject implements AInterface
{
    /**
     * Construct a HTML anchor DOM Object.
     */
    public function __construct()
    {
        parent::__construct('a');
    }

    /**
     * Set the Href.
     *
     * @param string $href The href for the anchor.
     *
     * @return $this
     */
    public function setHref(string $href)
    {
        return $this->setAttribute('href', $href);
    }

    /**
     * Set the target.
     *
     * @param string $target The target for the anchor.
     *
     * @return $this
     */
    public function setTarget(string $target)
    {
        return $this->setAttribute('target', $target);
    }
}
