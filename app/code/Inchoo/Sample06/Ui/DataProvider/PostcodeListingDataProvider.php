<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Ui\DataProvider;

use Inchoo\Sample06\Model\ResourceModel\Postcode\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class PostcodeListingDataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * PostcodeListingDataProvider constructor.
     * @param CollectionFactory $collectionFactory
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return \Inchoo\Sample06\Model\ResourceModel\Postcode\Collection
     */
    public function getCollection()
    {
        if (null === $this->collection) {
            $this->collection = $this->collectionFactory->create();
        }

        return $this->collection;
    }
}
