<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class PostcodeActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * PostcodeActions constructor.
     * @param UrlInterface $url
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        UrlInterface $url,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->url = $url;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        $name = $this->getData('name');

        foreach ($dataSource['data']['items'] as &$item) {
            if (!isset($item['entity_id'])) {
                continue;
            }

            $item[$name]['edit'] = [
                'href' => $this->url->getUrl('sample06/postcode/edit', ['id' => $item['entity_id']]),
                'label' => __('Edit')
            ];

            $item[$name]['delete'] = [
                'href' => $this->url->getUrl('sample06/postcode/delete', ['id' => $item['entity_id']]),
                'label' => __('Delete'),
                'confirm' => [
                    'message' => __('Are you sure you want to delete this record?')
                ]
            ];
        }

        return $dataSource;
    }
}
