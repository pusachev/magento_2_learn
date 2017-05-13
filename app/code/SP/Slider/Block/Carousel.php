<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Block;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use SP\Slider\Api\Data\CarouselInterface;
use SP\Slider\Model\ResourceModel\Carousel\CollectionFactory;

class Carousel extends Template implements IdentityInterface
{
    /**
     * @var CollectionFactory
     */
    protected $_carouselCollectionFactory;

    /**
     * Construct
     *
     * @param Context           $context
     * @param CollectionFactory $postCollectionFactory,
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $eventCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_carouselCollectionFactory = $eventCollectionFactory;
    }


    /**
     * string[]
     */
    public function getSlides()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData(CarouselInterface::CACHE_TAG)) {
            $items = $this->_carouselCollectionFactory
                           ->create();
            $this->setData(CarouselInterface::CACHE_TAG, $items);
        }

        return $this->getData(CarouselInterface::CACHE_TAG);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentities()
    {
        return [CarouselInterface::CACHE_TAG];
    }
}
