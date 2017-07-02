<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Controller\Adminhtml\Slider;

use MageNet\SimpleSlider\Controller\Adminhtml\Slider as BaseAction;

class MassDelete extends BaseAction
{
    public function execute()
    {
        $ids = $this->getRequest()->getParam('ids');

        foreach ($ids as $id) {
            try {
                $model = $this->modelFactory->create();
                $model->setId($id);
                $this->entityManager->delete($model);
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
                $this->messageManager->addErrorMessage(__('Item with id %1 not delete', $id));
            }
        }

        if (count($ids)) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) were deleted.', count($ids))
            );
        }

        $this->_redirect('*/*/index');
    }
}
