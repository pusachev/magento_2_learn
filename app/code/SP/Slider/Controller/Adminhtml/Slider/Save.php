<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Controller\Adminhtml\Slider;

use SP\Slider\Api\Data\CarouselInterface;
use SP\Slider\Controller\Adminhtml\Slider;

class Save extends Slider
{
    /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $model = $this->_carouselFactory->create();
            $id = $this->getRequest()->getParam('slider')[CarouselInterface::CAROUSEL_ID];

            if ($id) {
                $model->load($id);
            }
            $formData = $this->getRequest()->getParam('slider');
            if (is_array($formData['image'])) {
                $formData['image'] = $formData['image']['value'];
            }
            $model->setData($formData);

            try {

                if (!empty($_FILES['image']['name'])) {

                    $model->setData(
                        CarouselInterface::CAROUSEL_IMAGE,
                        $this->dataHelper->uploadImage('image')
                    );
                }

                $model->save();

                $this->messageManager->addSuccess(__('The slider has been saved.'));

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                    return;
                }

                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $id]);
        }
    }
}
