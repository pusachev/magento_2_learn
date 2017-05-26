<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Controller\Adminhtml\Slider;

use Magento\Backend\Model\View\Result\Page;

use SP\Slider\Controller\Adminhtml\Slider;
use SP\Slider\Model\Carousel;
use SP\Slider\Block\Adminhtml\Slider\Edit as EditFormBlock;

class Edit extends Slider
{
    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Slider $model */
        $model = $this->_carouselFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This slider no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register(EditFormBlock::REGISTRY_KEY, $model);

        /** @var Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('SP_Slider::slider');
        $resultPage->getConfig()->getTitle()->prepend(__('SP Slider'));

        return $resultPage;
    }

    /*
    * Check permission via ACL resource
    */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SP_Slider::admin_edit');
    }
}