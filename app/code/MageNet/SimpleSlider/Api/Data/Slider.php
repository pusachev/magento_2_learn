<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Api\Data;


interface SliderInterface
{
    const SLIDER_TABLE_NAME         = 'magenet_slider';

    const ID_COLUMN_NAME            = 'slider_id';
    const IMAGE_COLUMN_NAME         = 'image';
    const ALT_COLUMN_NAME           = 'alt';
    const DESCRIPTION_COLUMN_NAME   = 'description';
    const URL_COLUMN_NAME           = 'url';
    const DISPLAY_FROM_COLUMN_NAME  = 'display_from';
    const DISPLAY_TO_COLUMN_NAME    = 'display_to';
    const STATUS_COLUMN_NAME        = 'status';

    const STATUS_ENABLED            = 1;
    const STATUS_DISABLED           = 0;

    const CACHE_TAG                 = 'magenet_slider';
    const EVENT_PREFIX              = 'magenet_slider';

    const REGISTRY_KEY              = 'magenet_simple_slider';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $image
     * @return SliderInterface
     */
    public function setImage($image);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param string $alt
     * @return SliderInterface
     */
    public function setAlt($alt);

    /**
     * @return string
     */
    public function getAlt();

    /**
     * @param string $description
     * @return SliderInterface
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string|\DateTime $dateFrom
     * @return SliderInterface
     */
    public function setDisplayFrom($dateFrom);

    /**
     * @return string
     */
    public function getDisplayFrom();

    /**
     * @param string $url
     * @return SliderInterface
     */
    public function setUrl($url);

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string|\DateTime $dateTo
     * @return SliderInterface
     */
    public function setDisplayTo($dateTo);

    /**
     * @return string
     */
    public function getDisplayTo();

    /**
     * @param int $status
     * @return SliderInterface
     */
    public function setStatus($status);

    /**
     * @return bool
     */
    public function getStatus();
}
