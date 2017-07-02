<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Controller\Adminhtml\Slider;

use MageNet\SimpleSlider\Controller\Adminhtml\Slider as BaseAction;
use MageNet\SimpleSlider\Api\Data\SliderInterface;

class Edit extends BaseAction
{
    const ACL_RESOURCE      = 'MageNet_SimpleSlider::edit';
    const MENU_ITEM         = 'MageNet_SimpleSlider::edit';
    const PAGE_TITLE        = 'Edit Slide';
    const BREADCRUMB_TITLE  = 'Edit Slide';

    /** {@inheritdoc} */
    public function execute()
    {
        $parent = parent::execute();

        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        $model = $this->modelFactory->create();

        if (!empty($id)) {
            $model = $this->entityManager->load($model, $id);
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(SliderInterface::REGISTRY_KEY, $model);

        return $parent;
    }
}
