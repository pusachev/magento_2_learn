<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template\Context;

use SP\Events\Api\Data\EventInterface;
use SP\Events\Model\ResourceModel\Event;
use SP\Events\Model\Event as EventModel;
use SP\Events\Model\ResourceModel\Event\Collection as EventCollection;
use SP\Events\Model\ResourceModel\Event\CollectionFactory;

class EventList extends Template implements IdentityInterface
{
    /**
     * @var CollectionFactory
     */
    protected $_eventCollectionFactory;

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
        $this->_eventCollectionFactory = $eventCollectionFactory;
    }

    /**
     * @return EventCollection
     */
    public function getEvents()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('events')) {
            $events = $this->_eventCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->addOrder(
                    EventInterface::DISPLAY_FROM,
                    'DESC'
                );
            $this->setData('events', $events);
        }

        return $this->getData('events');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [EventModel::CACHE_TAG . '_' . 'list'];
    }

}