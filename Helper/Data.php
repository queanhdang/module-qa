<?php
namespace AHT\QA\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $_customerSession;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
    }

    public function getCustomerSession() {
        return $this->_customerSession;
    }
}