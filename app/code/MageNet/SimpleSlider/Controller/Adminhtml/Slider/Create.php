<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Controller\Adminhtml\Slider;

use MageNet\SimpleSlider\Controller\Adminhtml\Slider\Edit as BaseAction;

class Create extends BaseAction
{
    const ACL_RESOURCE      = 'MageNet_SimpleSlider::new';
    const MENU_ITEM         = 'MageNet_SimpleSlider::new';
    const PAGE_TITLE        = 'Add Slide';
    const BREADCRUMB_TITLE  = 'Add Slide';
}