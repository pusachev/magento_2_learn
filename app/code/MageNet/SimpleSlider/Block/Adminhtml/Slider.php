<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Slider extends Container
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'MageNet_SimpleSlider';
        $this->_headerText = __('Slider items');
        $this->_addButtonLabel = __('Create new');

        parent::_construct();
    }
}
