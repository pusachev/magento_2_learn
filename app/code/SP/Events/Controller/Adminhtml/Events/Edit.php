<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Controller\Adminhtml\Events;

use SP\Events\Controller\Adminhtml\Events;
use SP\Events\Model\Event;

class Edit extends Events
{
    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Event $model */
        $model = $this->_eventFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getEventData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('sp_events', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('SP_Events::events');
        $resultPage->getConfig()->getTitle()->prepend(__('SP Events'));

        return $resultPage;
    }
}