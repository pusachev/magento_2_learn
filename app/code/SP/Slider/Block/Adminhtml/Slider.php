<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Slider extends Container
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'SP_Slider';
        $this->_headerText = __('Slider');
        $this->_addButtonLabel = __('Create New slider');
        parent::_construct();
    }
}