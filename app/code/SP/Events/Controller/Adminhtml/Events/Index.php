<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Controller\Adminhtml\Events;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use SP\Events\Controller\Adminhtml\Events;

class Index extends Events
{
    public function execute()
    {
        //Call page factory to render layout and page content
        $this->_setPageData();

        return $this->getResultPage();
    }

    /*
     * Check permission via ACL resource
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SP_Events::grid');
    }

    /**
     * @return mixed
     */
    public function getResultPage()
    {
        if (null === $this->_resultPage) {
            $this->_resultPage = $this->_resultPageFactory->create();
        }

        return $this->_resultPage;
    }

    protected function _setPageData()
    {
        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('SP_Events::events');
        $resultPage->getConfig()->getTitle()->prepend((__('Events')));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Events'), __('Events'));
        $resultPage->addBreadcrumb(__('Events Grid'), __('Events Grid'));

        return $this;
    }
}
