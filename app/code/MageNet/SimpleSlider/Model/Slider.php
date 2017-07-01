<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime;

use MageNet\SimpleSlider\Api\Data\SliderInterface;
use MageNet\SimpleSlider\Model\ResourceModel\Slider as ResourceModel;

class Slider
    extends AbstractModel
        implements IdentityInterface, SliderInterface
{
    /**
     * @var string
     */
    protected $_cacheTag = SliderInterface::CACHE_TAG;

    /**
     * @var string
     */
    protected $_eventPrefix = SliderInterface::EVENT_PREFIX;

    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getId()
    {
        return $this->getData(SliderInterface::ID_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setImage($image)
    {
        $this->setData(SliderInterface::IMAGE_COLUMN_NAME, $image);

        return $this;
    }

    /** {@inheritdoc} */
    public function getImage()
    {
        return $this->getData(SliderInterface::IMAGE_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setAlt($alt)
    {
        $this->setData(SliderInterface::ALT_COLUMN_NAME, $alt);

        return $this;
    }

    /** {@inheritdoc} */
    public function getAlt()
    {
        $this->getData(SliderInterface::ALT_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setDescription($description)
    {
        $this->setData(SliderInterface::DESCRIPTION_COLUMN_NAME, $description);

        return $this;
    }

    /** {@inheritdoc} */
    public function getDescription()
    {
        return $this->getData(SliderInterface::DESCRIPTION_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setUrl($url)
    {
        $this->setData(SliderInterface::URL_COLUMN_NAME, $url);

        return $this;
    }

    /** {@inheritdoc} */
    public function getUrl()
    {
        return $this->getData(SliderInterface::URL_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setDisplayFrom($dateFrom)
    {
        if ($dateFrom instanceof \DateTime) {
            $dateFrom = $dateFrom->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(SliderInterface::DISPLAY_FROM_COLUMN_NAME, $dateFrom);

        return $this;
    }

    /** {@inheritdoc} */
    public function getDisplayFrom()
    {
        return $this->getData(Slider::DISPLAY_FROM_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setDisplayTo($dateTo)
    {
        if ($dateTo instanceof \DateTime) {
            $dateTo = $dateTo->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(SliderInterface::DISPLAY_TO_COLUMN_NAME, $dateTo);

        return $this;
    }

    /** {@inheritdoc} */
    public function getDisplayTo()
    {
        return $this->setData(SliderInterface::DISPLAY_TO_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function setStatus($status)
    {
        $this->setData(SliderInterface::STATUS_COLUMN_NAME, $status);

        return $this;
    }

    /** {@inheritdoc} */
    public function getStatus()
    {
        return (bool) $this->getData(SliderInterface::STATUS_COLUMN_NAME);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s",SliderInterface::CACHE_TAG, $this->getId())];
    }
}
