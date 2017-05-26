<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

use MageNet\SimpleSlider\Api\Data\SliderInterface;

class Status implements ArrayInterface
{
    /** {@inheritdoc} */
    public function toOptionArray()
    {
        $options = [
            SliderInterface::STATUS_ENABLED  => __('Enabled'),
            SliderInterface::STATUS_DISABLED => __('Disabled')
        ];

        return $options;
    }
}