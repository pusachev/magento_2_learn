<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Block\Adminhtml\Slider\Edit\Tab;

use Magento\Framework\Data\Form;

use MageNet\SimpleSlider\Api\Data\SliderInterface;

class ImageInfo extends AbstractTab
{
    const TAB_LABEL     = 'Image';
    const TAB_TITLE     = 'Image';

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
            'image_fieldset',
            ['legend' => __('General')]
        );


        $fieldset->addField(
            SliderInterface::IMAGE_COLUMN_NAME,
            'image',
            [
                'name'        => SliderInterface::IMAGE_COLUMN_NAME,
                'label'    => __('Image'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            SliderInterface::ALT_COLUMN_NAME,
            'text',
            [
                'name'      => SliderInterface::ALT_COLUMN_NAME,
                'label'     => __('Alt'),
                'required'  => false
            ]
        );

        $data = $this->model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
