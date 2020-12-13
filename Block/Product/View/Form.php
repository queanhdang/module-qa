<?php
namespace AHT\QA\Block\Product\View;

class Form extends \Magento\Framework\View\Element\Template
{
    private $_registry;
    private $_customerSession;
    protected $_storeManager;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_registry = $registry;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
    public function getCustomerSession()
    {
        return $this->_customerSession;
    }
    public function getStoreManager()
    {
        return $this->_storeManager;
    }
}