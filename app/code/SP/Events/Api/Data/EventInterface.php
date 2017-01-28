<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Api\Data;


interface EventInterface
{
    const EVENT_ID              = 'event_id';
    const TITLE                 = 'title';
    const SHORT_DESCRIPTION     = 'short_description';
    const IMAGE                 = 'image';
    const DISPLAY_FROM          = 'display_from';
    const DISPLAY_TO            = 'display_to';
    const IS_ACTIVE             = 'is_active';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getShortDescription();

    /**
     * @return string
     */
    public function getImage();

    /**
     * @return string
     */
    public function getDisplayFrom();

    /**
     * @return string
     */
    public function getDisplayTo();

    /**
     * @return bool
     */
    public function getIsActive();

    /**
     * @param int $id
     *
     * @return EventInterface
     */
    public function setId($id);

    /**
     * @param string $title
     *
     * @return EventInterface
     */
    public function setTitle($title);

    /**
     * @param string $shortDescription
     *
     * @return  EventInterface
     */
    public function setShortDescription($shortDescription);

    /**
     * @param string $image
     *
     * @return EventInterface
     */
    public function setImage($image);

    /**
     * @param string $displayFrom
     *
     * @return EventInterface
     */
    public function setDisplayFrom($displayFrom);

    /**
     * @param string $displayTo
     *
     * @return EventInterface
     */
    public function setDisplayTo($displayTo);

    /**
     * @param bool $isActive
     *
     * @return EventInterface
     */
    public function setIsActive($isActive);


}
