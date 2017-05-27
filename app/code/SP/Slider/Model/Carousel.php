<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

use SP\Slider\Api\Data\CarouselInterface;
use SP\Slider\Model\ResourceModel\Carousel as CarouselResource;

class Carousel extends AbstractModel
    implements IdentityInterface, CarouselInterface
{
    /** @var \SP\Slider\Helper\Data */
    protected $helper;

    /**
     * @var string
     */
    protected $_cacheTag = CarouselInterface::CACHE_TAG;

    /**
     * @var string
     */
    protected $_eventPrefix = CarouselInterface::CACHE_TAG;


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CarouselResource::class);
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return (string) $this->getData(self::CAROUSEL_IMAGE);
    }

    /**
     * @param string $image
     * @return CarouselInterface
     */
    public function setImage(string $image): CarouselInterface
    {
        $this->setData(self::CAROUSEL_IMAGE, $image);

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->getData(self::CAROUSEL_ALT);
    }

    /**
     * @param string $alt
     * @return CarouselInterface
     */
    public function setAlt(string $alt): CarouselInterface
    {
        $this->setData(self::CAROUSEL_ALT, $alt);

        return $this;
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", self::CACHE_TAG, $this->getId())];
    }
}
