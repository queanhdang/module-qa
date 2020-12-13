<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\QA\Block\Customer;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Customer Reviews list block
 *
 * @api
 * @since 100.0.2
 */
class ListQuestion extends \Magento\Customer\Block\Account\Dashboard
{
    /**
     * Product reviews collection
     *
     * @var \Magento\Review\Model\ResourceModel\Review\Product\Collection
     */
    protected $_collection;

    /**
     * Review resource model
     *
     * @var \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory
     */
    protected $_collectionFactory;
    protected $_productRepository;
    protected $_storeManager;
    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param AccountManagementInterface $customerAccountManagement
     * @param \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $collectionFactory
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        CustomerRepositoryInterface $customerRepository,
        AccountManagementInterface $customerAccountManagement,
        \AHT\QA\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_productRepository = $productRepository;
        $this->_storeManager = $storeManager;
        parent::__construct(
            $context,
            $customerSession,
            $subscriberFactory,
            $customerRepository,
            $customerAccountManagement,
            $data
        );
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * Get html code for toolbar
     *
     * @return string
     */
    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

    /**
     * Initializes toolbar
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        if ($this->getQuestions()) {
            $toolbar = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'customer_question_list.toolbar'
            )->setCollection(
                $this->getQuestions()
            );

            $this->setChild('toolbar', $toolbar);
        }
        return parent::_prepareLayout();
    }

    /**
     * Get reviews
     *
     * @return bool|\Magento\Review\Model\ResourceModel\Review\Product\Collection
     */
    public function getQuestions()
    {
        if (!($customerId = $this->currentCustomer->getCustomerId())) {
            return false;
        }
        if (!$this->_collection) {
            $this->_collection = $this->_collectionFactory->create();
            $this->_collection
                ->addFieldToFilter('store_id',$this->_storeManager->getStore()->getId())
                ->addFieldToFilter('user_id',$this->currentCustomer->getCustomerId());
            $this->_collection
                ->getSelect()
                ->order('created_at' .' '. \Magento\Framework\DB\Select::SQL_DESC);
        }
        return $this->_collection;
    }

    /**
     * Get review link
     *
     * @return string
     * @deprecated 100.2.0
     */
    public function getQuestionLink()
    {
        return $this->getUrl('question/customer/view/');
    }

    /**
     * Get review URL
     *
     * @param \Magento\Review\Model\Review $review
     * @return string
     * @since 100.2.0
     */
    public function getQuestionUrl($question)
    {
        return $this->getUrl('qanda/customer/view', ['qa_id' => $question->getQaId()]);
    }

    /**
     * Get product link
     *
     * @return string
     * @deprecated 100.2.0
     */
    public function getProductLink()
    {
        return $this->getUrl('catalog/product/view/');
    }

    /**
     * Get product URL
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     * @since 100.2.0
     */
    public function getProductUrl($product)
    {
        return $product->getProductUrl();
    }

    /**
     * Format date in short format
     *
     * @param string $date
     * @return string
     */
    public function dateFormat($date)
    {
        return $this->formatDate($date, \IntlDateFormatter::SHORT);
    }
}
