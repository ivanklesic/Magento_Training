<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Model\Preference;

class DummyTwo implements DummyInterface
{
    /**
     * @return string
     */
    public function getClassName(): string
    {
        return get_class($this);
    }
}
