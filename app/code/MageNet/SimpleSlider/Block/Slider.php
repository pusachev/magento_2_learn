<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template\Context;

use MageNet\SimpleSlider\Api\Data\SliderInterface;
use MageNet\SimpleSlider\Model\Slider as SliderModel;
use MageNet\SimpleSlider\Model\ResourceModel\Slider as SliderResourceModel;
use MageNet\SimpleSlider\Model\ResourceModel\Slider\Collection as SliderCollection;
use MageNet\SimpleSlider\Model\ResourceModel\Slider\CollectionFactory;

class Slider extends Template implements IdentityInterface
{
    const COLLECTION_KEY = 'slider_collection';

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * Construct
     *
     * @param Context           $context
     * @param CollectionFactory $collectionFactory,
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_collectionFactory = $collectionFactory;
    }

    /**
     * @return SliderCollection
     */
    public function getEvents()
    {
        if (!$this->hasData(static::COLLECTION_KEY)) {
            $this->fillCollection();
        }

        return $this->getData(static::COLLECTION_KEY);
    }

    /**
     * Fill collection if not cached
     *
     * @return void
     */
    protected function fillCollection()
    {
        $collection = $this->_collectionFactory
                           ->create()
                           ->addFilter('is_active', SliderInterface::STATUS_ENABLED)
                           ->addOrder(
                                SliderInterface::DISPLAY_FROM_COLUMN_NAME,
                                'DESC'
                            );

        $this->setData(static::COLLECTION_KEY, $collection);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", SliderInterface::CACHE_TAG, 'list')];
    }
}
