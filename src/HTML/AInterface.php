<?php declare(strict_types = 1);

/**
 *
 * @author Darren Potter <darren@easyfundraising.org.uk>
 * @created 28/12/2016 21:33
 * @version 1.0
 */
namespace Devgorilla\DOMBuilder\DOMObject\HTML;

use Devgorilla\DOMBuilder\DOMObject;

interface AInterface extends DOMObject\DOMObjectInterface
{
    /**
     * Set the Href.
     *
     * @param string $href The href for the anchor.
     *
     * @return $this
     */
    public function setHref(string $href);

    /**
     * Set the target.
     *
     * @param string $target The target for the anchor.
     *
     * @return $this
     */
    public function setTarget(string $target);
}
