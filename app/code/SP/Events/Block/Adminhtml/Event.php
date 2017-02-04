<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Block\Adminhtml;

use \Magento\Backend\Block\Widget\Grid\Container;

class Event extends Container
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_events';
        $this->_blockGroup = 'SP_Events';
        $this->_headerText = __('Events');
        $this->_addButtonLabel = __('Create New Event');
        parent::_construct();
    }
}