<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Controller\Adminhtml\Slider;

use MageNet\SimpleSlider\Api\Data\SliderInterface;
use MageNet\SimpleSlider\Controller\Adminhtml\Slider as BaseAction;

class Save extends BaseAction
{
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $model = $this->modelFactory->create();
            $formData = $this->getRequest()->getParam('slider');

            if(!empty($formData[SliderInterface::ID_COLUMN_NAME])) {
                $id = $formData[SliderInterface::ID_COLUMN_NAME];
                $model = $this->entityManager->load($model, $id);
            }

            $model->setData($formData);

            try {
                $model = $this->entityManager->save($model);
                $this->messageManager->addSuccessMessage(__('The slider has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $this->_redirect('*/*/');
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
                $this->messageManager->addErrorMessage(__('Slide doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return $this->_redirect('*/*/edit', ['id' => $id]);
        }
    }
}
