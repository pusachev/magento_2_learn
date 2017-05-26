<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use MageNet\SimpleSlider\Api\Data\SliderInterface;

class Slider extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(SliderInterface::SLIDER_TABLE_NAME, SliderInterface::ID_COLUMN_NAME);
    }
}