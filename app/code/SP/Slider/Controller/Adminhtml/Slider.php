<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

use SP\Slider\Model\CarouselFactory;
use SP\Slider\Helper\Data;

abstract class Slider extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Result page factory
     *
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var CarouselFactory
     */
    protected $_carouselFactory;

    /**
     * @var Data
     */
    protected $dataHelper;

    protected $_resultPage = null;

    /**
     * @param Context           $context
     * @param Registry          $coreRegistry
     * @param PageFactory       $resultPageFactory
     * @param CarouselFactory   $carouselFactory
     * @param Data              $helper
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        CarouselFactory $carouselFactory,
        Data $helper
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_carouselFactory = $carouselFactory;
        $this->dataHelper = $helper;
    }
}
