<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Controller\Adminhtml\Events;

use SP\Events\Controller\Adminhtml\Events;
use SP\Events\Model\Event;

class MassDelete extends Events
{
    /**
     * @return void
     */
    public function execute()
    {
        // Get IDs of the selected news
        $ids = $this->getRequest()->getParam('events');

        foreach ($ids as $id) {
            try {
                /** @var Event $model */
                $model = $this->_eventFactory->create();
                $model->load($id)->delete();
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