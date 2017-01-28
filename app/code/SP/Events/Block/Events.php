<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class Events
 *
 * @package SP\Events\Block
 */
class Events extends Template
{
    /**
     * @return string
     */
    public function getEvents()
    {
        return __METHOD__;
    }

    /**
     * @return string
     */
    protected function getProtectedEvents()
    {
        return __METHOD__;
    }

    /**
     * @return string
     */
    private function getPrivateEvents()
    {
        return __METHOD__;
    }
}
