<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Api\Data;


interface CarouselInterface
{
    const CAROUSEL_ID       = 'carousel_id';
    const CAROUSEL_IMAGE    = 'image';
    const CAROUSEL_ALT      = 'alt';

    const CAROUSEL_TABLE    = 'sp_carousel';

    const CACHE_TAG = 'sp_carousel';

    /** @return string */
    public function getImage(): string;

    /**
     * @param string $image
     * @return CarouselInterface
     */
    public function setImage(string $image) : CarouselInterface;

    /** @return string */
    public function getAlt() : string ;

    /**
     * @param string $alt
     * @return CarouselInterface
     */
    public function setAlt(string $alt) : CarouselInterface;
}
