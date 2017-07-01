<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Controller\Adminhtml\Slider;

use SP\Slider\Model\Carousel;
use SP\Slider\Controller\Adminhtml\Slider;

class Delete extends Slider
{
    /**
     * @return void
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('id');

        if ($id) {
            /** @var Carousel $model */
            $model = $this->_carouselFactory->create();
            $model->load($id);

            // Check this news exists or not
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
            } else {
                try {
                    //$this->dataHelper->removeImage($model->getImage());
                    // Delete news
                    $model->delete();
                    $this->messageManager->addSuccess(__('The news has been deleted.'));

                    // Redirect to grid page
                    $this->_redirect('*/*/');
                    return;
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    $this->_redirect('*/*/edit', ['id' => $model->getId()]);
                }
            }
        }
    }
}
