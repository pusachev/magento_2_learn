<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

use SP\Events\Api\Data\EventInterface;
use  SP\Events\Model\ResourceModel\Event as EventResource;

/**
 * Class Event
 *
 * @package SP\Events\Model
 */
class Event extends AbstractModel implements IdentityInterface, EventInterface
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;

    const CACHE_TAG = 'sp_events';

    /**
     * @var string
     */
    protected $_cacheTag = 'sp_events';

    /**
     * @var string
     */
    protected $_eventPrefix = 'sp_events';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(EventResource::class);
    }

    /**
     * Prepare post's statuses.
     * Available event sp_events_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ACTIVE => __('Enapled'),
            self::STATUS_INACTIVE => __('Disabled')
        ];
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::EVENT_ID);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->getData(self::SHORT_DESCRIPTION);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @return string
     */
    public function getDisplayFrom()
    {
        return $this->getData(self::DISPLAY_FROM);
    }

    public function getDisplayTo()
    {
        return $this->getData(self::DISPLAY_TO);
    }

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * @param int $id
     *
     * @return EventInterface
     */
    public function setId($id)
    {
        return $this->setData(self::EVENT_ID, $id);
    }

    /**
     * @param string $title
     *
     * @return EventInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @param string $shortDescription
     *
     * @return EventInterface
     */
    public function setShortDescription($shortDescription)
    {
        return $this->setData(self::SHORT_DESCRIPTION, $shortDescription);
    }

    /**
     * @param string $image
     *
     * @return EventInterface
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @param string $displayFrom
     *
     * @return EventInterface
     */
    public function setDisplayFrom($displayFrom)
    {
        return $this->setData(self::DISPLAY_FROM, $displayFrom);
    }

    /**
     * @param string $displayTo
     *
     * @return EventInterface
     */
    public function setDisplayTo($displayTo)
    {
        return $this->setData(self::DISPLAY_TO, $displayTo);
    }

    /**
     * @param bool $isActive
     *
     * @return EventInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
}
