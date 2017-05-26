<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

use MageNet\SimpleSlider\Api\Data\SliderInterface
use MageNet\SimpleSlider\Model\ResourceModel\Slider as ResourceModel;

class Slider
    extends AbstractModel
        implements IdentityInterface, SliderInterface
{
    public function getId()
    {
        return $this->getData(SliderInterface::ID_COLUMN_NAME);
    }

    /**
     * @param string $image
     * @return SliderInterface
     */
    public function setImage($image)
    {
        $this->setData(SliderInterface::IMAGE_COLUMN_NAME, $image);

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getData(SliderInterface::IMAGE_COLUMN_NAME);.
    }

    /**
     * @param string $alt
     * @return SliderInterface
     */
    public function setAlt($alt)
    {
        $this->setData(SliderInterface::ALT_COLUMN_NAME, $alt);

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        $this->getData(SliderInterface::ALT_COLUMN_NAME);
    }

    /**
     * @param string $description
     * @return SliderInterface
     */
    public function setDescription($description)
    {
        $this->setData(SliderInterface::DESCRIPTION_COLUMN_NAME, $description);

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(SliderInterface::DESCRIPTION_COLUMN_NAME);
    }

    public function setDisplayFrom($dateFrom)
    {
        if ($dateFrom instanceof \DateTime) {
            $dateFrom = $dateFrom->format('m-d-Y');
        }

        $this->setData(SliderInterface::DISPLAY_FROM_COLUMN_NAME, $dateFrom);

        return $this;
    }

    public function getDisplayFrom()
    {
        return $this->getData(Slider::DISPLAY_FROM_COLUMN_NAME);
    }

    public function setDisplayTo($dateTo)
    {
        // TODO: Implement setDisplayTo() method.
    }

    public function getDisplayTo()
    {
        // TODO: Implement getDisplayTo() method.
    }

    /**
     * @param int $status
     * @return SliderInterface
     */
    public function setStatus($status)
    {
        $this->setData(SliderInterface::STATUS_COLUMN_NAME, $status);

        return $this;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return (bool) $this->getData(SliderInterface::STATUS_COLUMN_NAME);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [sprintf("%s_%s",SliderInterface::CACHE_TAG, $this->getId())];
    }
}
