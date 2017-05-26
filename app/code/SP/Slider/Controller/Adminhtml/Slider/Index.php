<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Controller\Adminhtml\Slider;

use SP\Slider\Controller\Adminhtml\Slider;

class Index extends Slider
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
        return $this->_authorization->isAllowed('SP_Slider::index_test');
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
        $resultPage->setActiveMenu('SP_Slider::grid');
        $resultPage->getConfig()->getTitle()->prepend((__('Slider')));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Slider'), __('Slider'));
        $resultPage->addBreadcrumb(__('Slider Grid'), __('Slider Grid'));

        return $this;
    }
}
