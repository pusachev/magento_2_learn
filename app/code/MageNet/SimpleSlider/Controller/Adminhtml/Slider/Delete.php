<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Controller\Adminhtml\Slider;

use MageNet\SimpleSlider\Controller\Adminhtml\Slider as BaseAction;
use Magento\Framework\Controller\ResultFactory;

class Delete extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (empty($id)) {
            $this->messageManager->addMessage(__('No item to delete'));
            return $this->_redirect('*/*/');
        }

        $model = $this->modelFactory->create();
        $model->setId($id);

        if (!$model->getId()) {
            $this->messageManager->addErrorMessage(__('This item no longer exists.'));
            return $this->_redirect('*/*/');
        }

        try {
            $this->entityManager->delete($model);
            $this->messageManager->addSuccessMessage(__('The news has been deleted.'));
            return $this->_redirect('*/*/');
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $redirect->setUrl($this->_redirect->getRefererUrl());
            $this->messageManager->addErrorMessage($e->getMessage());
            return $redirect;
        }
    }
}
