<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Model;

use Inchoo\Sample05\Api\Data\EventInterface;
use Inchoo\Sample05\Api\Data\EventInterfaceFactory;
use Inchoo\Sample05\Api\Data\EventSearchResultInterface;
use Inchoo\Sample05\Api\Data\EventSearchResultInterfaceFactory;
use Inchoo\Sample05\Api\EventRepositoryInterface;
use Inchoo\Sample05\Model\ResourceModel\Event as EventResource;
use Inchoo\Sample05\Model\ResourceModel\Event\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class EventRepository implements EventRepositoryInterface
{
    /**
     * @var EventResource
     */
    protected $eventResource;

    /**
     * @var EventInterfaceFactory
     */
    protected $eventFactory;

    /**
     * @var CollectionFactory
     */
    protected $eventCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var EventSearchResultInterfaceFactory
     */
    protected $eventSearchResultFactory;

    /**
     * EventRepository constructor.
     * @param EventResource $eventResource
     * @param EventInterfaceFactory $eventFactory
     * @param CollectionFactory $eventCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param EventSearchResultInterfaceFactory $eventSearchResultFactory
     */
    public function __construct(
        EventResource $eventResource,
        EventInterfaceFactory $eventFactory,
        CollectionFactory $eventCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        EventSearchResultInterfaceFactory $eventSearchResultFactory
    ) {
        $this->eventResource = $eventResource;
        $this->eventFactory = $eventFactory;
        $this->eventCollectionFactory = $eventCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->eventSearchResultFactory = $eventSearchResultFactory;
    }

    /**
     * @param int $id
     * @return EventInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): EventInterface
    {
        /** @var Event $event */
        $event = $this->eventFactory->create();
        $this->eventResource->load($event, $id);

        if (!$event->getEntityId()) {
            throw new NoSuchEntityException(__('The Event with the "%1" id does not exist.', $id));
        }

        return $event;
    }

    /**
     * @param EventInterface|Event $event
     * @return EventInterface
     * @throws CouldNotSaveException
     */
    public function save(EventInterface $event): EventInterface
    {
        // TODO: Implement save() method.
    }

    /**
     * @param EventInterface|Event $event
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(EventInterface $event): bool
    {
        try {
            $this->eventResource->delete($event);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->get($id));
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return EventSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): EventSearchResultInterface
    {
        /** @var \Inchoo\Sample05\Model\ResourceModel\Event\Collection $collection */
        $collection = $this->eventCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Inchoo\Sample05\Api\Data\EventSearchResultInterface $searchResult */
        $searchResult = $this->eventSearchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }
}
