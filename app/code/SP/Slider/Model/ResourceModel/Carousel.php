<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use SP\Slider\Api\Data\CarouselInterface;

class Carousel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(CarouselInterface::CAROUSEL_TABLE, CarouselInterface::CAROUSEL_ID);
    }
}
