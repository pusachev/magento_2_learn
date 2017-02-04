<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Block\Adminhtml\Event\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

use SP\Events\Model\System\Config\Status;
use SP\Events\Model\Event;

class Info extends Generic implements TabInterface
{
    /**
     * @var Config
     */
    protected $_wysiwygConfig;

    /**
     * @var Status
     */
    protected $_eventStatus;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $eventStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $eventStatus,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_eventStatus = $eventStatus;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
        /** @var $model Event */
        $model = $this->_coreRegistry->registry('sp_events');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('events_');
        $form->setFieldNameSuffix('events');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name'      => 'status',
                'label'     => __('Status'),
                'options'   => $this->_eventStatus->toOptionArray()
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'description',
            'editor',
            [
                'name'     => 'description',
                'label'    => __('Description'),
                'required'  => true,
                'config'    => $wysiwygConfig
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Event Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Event Info');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
