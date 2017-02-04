<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Controller\Adminhtml\Events;

use SP\Events\Controller\Adminhtml\Events;
use SP\Events\Model\Event;

class Delete extends Events
{
    /**
     * @return void
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('id');

        if ($id) {
            /** @var Event $model */
            $model = $this->_eventFactory->create();
            $model->load($id);

            // Check this news exists or not
            if (!$model->getId()) {
                $this->messageManager->addError(__('This event no longer exists.'));
            } else {
                try {
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
