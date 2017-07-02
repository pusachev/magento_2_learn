<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Controller\Adminhtml;

use Monolog\Logger;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\EntityManager\EntityManager;

use MageNet\SimpleSlider\Helper\Data;
use MageNet\SimpleSlider\Model\SliderFactory;

abstract class Slider extends Action
{
    const ACL_RESOURCE          = 'MageNet_SimpleSlider::index';
    const MENU_ITEM             = 'MageNet_SimpleSlider::index';
    const PAGE_TITLE            = 'Simple Slider';
    const BREADCRUMB_TITLE      = 'Slider Grid';

    const QUERY_PARAM_ID        = 'slide_id';

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var Data  */
    protected $helper;

    /** @var  SliderFactory */
    protected $modelFactory;

    /** @var Page */
    protected $resultPage;

    /** @var EntityManager */
    protected $entityManager;

    /** @var Logger */
    protected $logger;

    /**
     * Slider constructor.
     * @param Context       $context
     * @param Registry      $registry
     * @param PageFactory   $pageFactory
     * @param EntityManager $entityManager
     * @param SliderFactory $factory
     * @param Data          $helper
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        EntityManager $entityManager,
        SliderFactory $factory,
        Data $helper,
        Logger $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->entityManager  = $entityManager;
        $this->modelFactory   = $factory;
        $this->helper         = $helper;
        $this->logger         = $logger;

        parent::__construct($context);
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();

        return $this->resultPage;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return Slider
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));

        $resultPage->addBreadcrumb(__('Slider'), __('Slider'));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }
}
