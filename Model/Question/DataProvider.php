<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\QA\Model\Question;

use AHT\QA\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use AHT\QA\Model\QuestionFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    protected $questionFactory;
    
    protected $productRepository;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    protected $storeManager;
    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->questionFactory = $questionFactory;
        $this->productRepository = $productRepository;
        $this->dataPersistor = $dataPersistor;
        $this->storeManager =  $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->collection->getSelect()
                         ->joinLeft('catalog_product_entity_varchar as pro','main_table.product_id = pro.entity_id AND pro.attribute_id = 73 ',array('*'));
        $items = $this->collection->getItems();
        foreach($items as $item) {
            $url = $this->storeManager->getStore()->getBaseUrl() .'catalog/product/edit/id/'.$item->getId();
            $link = '<a href="' . $url . '">' . $item->getData('value') . '</a>';
            $item->setData('value',$link);
        }
        /** @var \Magento\Cms\Model\Block $block */
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }

        $data = $this->dataPersistor->get('aht_question');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('aht_question');
        }

        return $this->loadedData;
    }
}
