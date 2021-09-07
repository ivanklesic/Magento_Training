<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface EventSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Inchoo\Sample05\Api\Data\EventInterface[]
     */
    public function getItems();

    /**
     * @param \Inchoo\Sample05\Api\Data\EventInterface[] $items
     * @return \Inchoo\Sample05\Api\Data\EventSearchResultInterface
     */
    public function setItems(array $items);
}
