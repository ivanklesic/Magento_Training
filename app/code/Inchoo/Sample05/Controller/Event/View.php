<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Controller\Event;

use Inchoo\Sample05\Api\EventRepositoryInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;

class View implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

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
     * View constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param Registry $registry
     * @param EventRepositoryInterface $eventRepository
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        Registry $registry,
        EventRepositoryInterface $eventRepository
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->registry = $registry;
        $this->eventRepository = $eventRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        if (!$eventId = $this->request->getParam('id')) {
            return $this->createNoRouteResult();
        }

        try {
            $event = $this->eventRepository->get((int)$eventId);
            $this->registry->register('current_event', $event);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return $this->createNoRouteResult();
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set($event->getTitle());

        return $resultPage;
    }

    /**
     * @return ResultInterface
     */
    protected function createNoRouteResult(): ResultInterface
    {
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

        return $resultForward->forward('noroute');
    }
}
