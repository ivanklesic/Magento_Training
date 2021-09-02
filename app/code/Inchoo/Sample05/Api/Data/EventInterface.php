<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Api\Data;

interface EventInterface
{
    public const ENTITY_ID   = 'entity_id';
    public const STATUS      = 'status';
    public const TITLE       = 'title';
    public const DESCRIPTION = 'description';
    public const URL         = 'event_url';
    public const START_DATE  = 'start_date';
    public const END_DATE    = 'end_date';

    /**
     * @return mixed|null
     */
    public function getEntityId();

    /**
     * @param mixed $entityId
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setEntityId($entityId);

    /**
     * @return mixed|null
     */
    public function getStatus();

    /**
     * @param mixed $status
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setStatus($status);

    /**
     * @return mixed|null
     */
    public function getTitle();

    /**
     * @param mixed $title
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setTitle($title);

    /**
     * @return mixed|null
     */
    public function getDescription();

    /**
     * @param mixed $description
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setDescription($description);

    /**
     * @return mixed|null
     */
    public function getUrl();

    /**
     * @param mixed $url
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setUrl($url);

    /**
     * @return mixed|null
     */
    public function getStartDate();

    /**
     * @param mixed $startDate
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setStartDate($startDate);

    /**
     * @return mixed|null
     */
    public function getEndDate();

    /**
     * @param mixed $endDate
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     */
    public function setEndDate($endDate);
}
