<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Api;

use Inchoo\Sample05\Api\Data\EventInterface;
use Inchoo\Sample05\Api\Data\EventSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface EventRepositoryInterface
{
    /**
     * @param int $id
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $id): EventInterface;

    /**
     * @param \Inchoo\Sample05\Api\Data\EventInterface $event
     * @return \Inchoo\Sample05\Api\Data\EventInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(EventInterface $event): EventInterface;

    /**
     * @param \Inchoo\Sample05\Api\Data\EventInterface $event
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(EventInterface $event): bool;

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Inchoo\Sample05\Api\Data\EventSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): EventSearchResultInterface;
}
