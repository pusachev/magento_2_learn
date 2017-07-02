<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

use MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit\Tab\ImageInfo as ImageInfoTab;
use MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit\Tab\DisplaySetting as DisplaySettingTab;
use MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit\Tab\General as GeneralTab;

class Tabs extends WidgetTabs
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('magenet_simple_slider_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Item information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    GeneralTab::class
                )->toHtml(),
                'active' => true
            ]
        )
            ->addTab(
            'image_info',
                [
                    'label' => __('Image info'),
                    'title' => __('Image info'),
                    'content' => $this->getLayout()->createBlock(
                    ImageInfoTab::class
                    )->toHtml(),
                    'active' => false
                ]
            )
            ->addTab(
                'display_setting',
                [
                    'label' => __('Display setting'),
                    'title' => __('Display setting'),
                    'content' => $this->getLayout()->createBlock(
                        DisplaySettingTab::class
                    )->toHtml(),
                    'active' => false
                ]
            );

        return parent::_beforeToHtml();
    }
}