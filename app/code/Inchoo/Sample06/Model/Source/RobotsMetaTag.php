<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class RobotsMetaTag implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => __('-- Please Select --')],
            ['value' => 'INDEX,FOLLOW', 'label' => 'INDEX,FOLLOW'],
            ['value' => 'INDEX,NOFOLLOW', 'label' => 'INDEX,NOFOLLOW'],
            ['value' => 'NOINDEX,FOLLOW', 'label' => 'NOINDEX,FOLLOW'],
            ['value' => 'NOINDEX,NOFOLLOW', 'label' => 'NOINDEX,NOFOLLOW']
        ];
    }
}
