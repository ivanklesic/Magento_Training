<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Model;

use Inchoo\Sample05\Api\Data\EventSearchResultInterface;
use Magento\Framework\Api\SearchResults;

class EventSearchResult extends SearchResults implements EventSearchResultInterface
{

}
