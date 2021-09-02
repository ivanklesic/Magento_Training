<?php

declare(strict_types=1);

namespace Inchoo\Sample05\ViewModel;

use Inchoo\Sample05\Api\Data\EventInterface;
use Inchoo\Sample05\Api\EventRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Event implements ArgumentInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var EventRepositoryInterface
     */
    protected $eventRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Event constructor.
     * @param RequestInterface $request
     * @param Registry $registry
     * @param EventRepositoryInterface $eventRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        RequestInterface $request,
        Registry $registry,
        EventRepositoryInterface $eventRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->request = $request;
        $this->registry = $registry;
        $this->eventRepository = $eventRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return EventInterface|null
     */
    public function getCurrentEvent(): ?EventInterface
    {
        if ($currentEvent = $this->registry->registry('current_event')) {
            return $currentEvent;
        }

        if ($eventId = $this->request->getParam('id')) {
            return $this->getEventById((int)$eventId);
        }

        return null;
    }

    /**
     * @param int $id
     * @return EventInterface|null
     */
    public function getEventById(int $id): ?EventInterface
    {
        try {
            return $this->eventRepository->get($id);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * @param int|null $pageSize
     * @return EventInterface[]
     */
    public function getEventList(int $pageSize = null): array
    {
        if ($pageSize) {
            $this->searchCriteriaBuilder->setPageSize($pageSize);
        }

        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->eventRepository->getList($searchCriteria)->getItems();
    }
}
