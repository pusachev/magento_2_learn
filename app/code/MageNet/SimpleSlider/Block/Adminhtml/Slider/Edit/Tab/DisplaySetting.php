<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit\Tab;

use Magento\Framework\Data\Form;

use MageNet\SimpleSlider\Api\Data\SliderInterface;

class DisplaySetting extends AbstractTab
{
    /**
     * Prepare form fields
     *
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('slider_');
        $form->setFieldNameSuffix('slider');

        $fieldset = $form->addFieldset(
            'diaplay_setting_fieldset',
            ['legend' => __('General')]
        );


        $fieldset->addField(
            SliderInterface::DISPLAY_FROM_COLUMN_NAME,
            'date',
            [
                'name'          => SliderInterface::DISPLAY_FROM_COLUMN_NAME,
                'label'         => __('Display From'),
                'date_format'   => 'yyyy-MM-dd',
                'required'      => false
            ]
        );
        $fieldset->addField(
            SliderInterface::DISPLAY_TO_COLUMN_NAME,
            'date',
            [
                'name'          => SliderInterface::DISPLAY_TO_COLUMN_NAME,
                'label'         => __('Display To'),
                'date_format'   => 'yyyy-MM-dd',
                'required'      => false
            ]
        );

        $fieldset->addField(
            SliderInterface::STATUS_COLUMN_NAME,
            'select',
            [
                'name'      => SliderInterface::STATUS_COLUMN_NAME,
                'label'     => __('Status'),
                'values'    => $this->sourceModel->toOptionArray(),
                'value'     => [0],
                'required'  => true
            ]
        );

        $data = $this->model->getData();
        if (empty($data[SliderInterface::STATUS_COLUMN_NAME])) {
            $data[SliderInterface::STATUS_COLUMN_NAME] = 1;
        }
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}