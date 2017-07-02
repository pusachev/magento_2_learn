<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit\Tab;

use Magento\Framework\Data\Form;

use MageNet\SimpleSlider\Api\Data\SliderInterface;

class General extends AbstractTab
{
    const TAB_LABEL     = 'General';
    const TAB_TITLE     = 'General';

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
            'general_fieldset',
            ['legend' => __('General')]
        );

        if ($this->model->getData(SliderInterface::ID_COLUMN_NAME)) {
            $fieldset->addField(
                SliderInterface::ID_COLUMN_NAME,
                'hidden',
                ['name' => SliderInterface::ID_COLUMN_NAME]
            );
        }

        $fieldset->addField(
            SliderInterface::DESCRIPTION_COLUMN_NAME,
            'editor',
            [
                'name'      => SliderInterface::DESCRIPTION_COLUMN_NAME,
                'label'     => __('Description'),
                'required'  => true,
                'config'    => $this->wysiwygConfig->getConfig()
            ]
        );

        $data = $this->model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
