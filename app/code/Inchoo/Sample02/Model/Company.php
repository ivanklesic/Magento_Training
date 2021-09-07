<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Model;

use Magento\Framework\DataObject;

class Company extends DataObject
{
    /**
     * @param string $name
     * @return Company
     */
    public function setName(string $name): self
    {
        return $this->setData('name', $name);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->_getData('name');
    }
}
