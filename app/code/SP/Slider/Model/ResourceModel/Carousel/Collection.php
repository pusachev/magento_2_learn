<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Model\ResourceModel\Carousel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use SP\Slider\Api\Data\CarouselInterface;
use SP\Slider\Model\Carousel as Model;
use SP\Slider\Model\ResourceModel\Carousel as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = CarouselInterface::CAROUSEL_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
