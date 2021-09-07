<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Model;

use Inchoo\Sample05\Api\Data\EventInterface;
use Magento\Framework\Model\AbstractModel;

class Event extends AbstractModel implements EventInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Inchoo\Sample05\Model\ResourceModel\Event::class);
    }

    /**
     * @return mixed|null
     */
    public function getEntityId()
    {
        return $this->_getData(EventInterface::ENTITY_ID);
    }

    /**
     * @param mixed $entityId
     * @return EventInterface|Event
     */
    public function setEntityId($entityId)
    {
        return $this->setData(EventInterface::ENTITY_ID, $entityId);
    }

    /**
     * @return mixed|null
     */
    public function getStatus()
    {
        return $this->_getData(EventInterface::STATUS);
    }

    /**
     * @param mixed $status
     * @return mixed
     */
    public function setStatus($status)
    {
        return $this->setData(EventInterface::STATUS, $status);
    }

    /**
     * @return mixed|null
     */
    public function getTitle()
    {
        return $this->_getData(EventInterface::TITLE);
    }

    /**
     * @param mixed $title
     * @return EventInterface|Event
     */
    public function setTitle($title)
    {
        return $this->setData(EventInterface::TITLE, $title);
    }

    /**
     * @return mixed|null
     */
    public function getDescription()
    {
        return $this->_getData(EventInterface::DESCRIPTION);
    }

    /**
     * @param mixed $description
     * @return EventInterface|Event
     */
    public function setDescription($description)
    {
        return $this->setData(EventInterface::DESCRIPTION, $description);
    }

    /**
     * @return mixed|null
     */
    public function getUrl()
    {
        return $this->_getData(EventInterface::URL);
    }

    /**
     * @param mixed $url
     * @return EventInterface|Event
     */
    public function setUrl($url)
    {
        return $this->setData(EventInterface::URL, $url);
    }

    /**
     * @return mixed|null
     */
    public function getStartDate()
    {
        return $this->_getData(EventInterface::START_DATE);
    }

    /**
     * @param mixed $startDate
     * @return EventInterface|Event
     */
    public function setStartDate($startDate)
    {
        return $this->setData(EventInterface::START_DATE, $startDate);
    }

    /**
     * @return mixed|null
     */
    public function getEndDate()
    {
        return $this->_getData(EventInterface::END_DATE);
    }

    /**
     * @param mixed $endDate
     * @return EventInterface|Event
     */
    public function setEndDate($endDate)
    {
        return $this->setData(EventInterface::END_DATE, $endDate);
    }
}
