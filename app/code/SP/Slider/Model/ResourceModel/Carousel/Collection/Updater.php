<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Model\ResourceModel\Carousel\Collection;

use Magento\Framework\View\Layout\Argument\UpdaterInterface;
use SP\Slider\Api\Data\CarouselInterface;

class Updater implements UpdaterInterface
{
    public function update($argument)
    {
        $argument->addFieldToFilter(CarouselInterface::CAROUSEL_ID, '1');

        return $argument;
    }
}