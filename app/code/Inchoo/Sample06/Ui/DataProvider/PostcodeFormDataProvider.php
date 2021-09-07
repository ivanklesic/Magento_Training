<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Ui\DataProvider;

use Inchoo\Sample06\Model\ResourceModel\Postcode\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class PostcodeFormDataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * PostcodeFormDataProvider constructor.
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->dataPersistor = $dataPersistor;
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

    /**
     * @return array
     */
    public function getData()
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        if ($data = $this->dataPersistor->get('inchoo_postcode')) {
            $productRule = $this->collection->getNewEmptyItem();
            $productRule->setData($data);
            $this->loadedData[$productRule->getId()] = $productRule->getData();
            $this->dataPersistor->clear('inchoo_postcode');
        }

        return $this->loadedData;
    }
}
