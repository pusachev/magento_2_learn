<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Model\ResourceModel\Event;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use SP\Events\Model\Event as EventModel;
use SP\Events\Model\ResourceModel\Event as EventResource;

/**
 * Class Collection
 *
 * @package SP\Events\Model\ResourceModel\Event
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'event_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(EventModel::class, EventResource::class);
    }
}