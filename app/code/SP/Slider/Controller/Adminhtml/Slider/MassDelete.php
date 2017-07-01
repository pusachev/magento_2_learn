<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Controller\Adminhtml\Slider;

use SP\Slider\Model\Carousel;
use SP\Slider\Controller\Adminhtml\Slider;

class MassDelete extends Slider
{
    /**
     * @return void
     */
    public function execute()
    {
        // Get IDs of the selected news
        $ids = $this->getRequest()->getParam('ids');

        foreach ($ids as $id) {
            try {
                /** @var Carousel $model */
                $model = $this->_carouselFactory->create();
                $model->load($id);
                //$this->dataHelper->removeImage($model->getImage());
                $model->delete();
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        if (count($ids)) {
            $this->messageManager->addSuccess(
                __('A total of %1 record(s) were deleted.', count($ids))
            );
        }

        $this->_redirect('*/*/index');
    }
}