<?php 
namespace AHT\QA\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface; 
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;


class Featured extends Template implements BlockInterface {

	protected $_template = "widget/featureds.phtml";
	protected $collection;
	protected $_productRepository;
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
		CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        array $data = []
	) {
		$this->_productRepository = $productRepository;
		$this->collection = $productCollectionFactory;
		parent::__construct($context, $data);
	}

	public function getList($quantity) {
		$featured = $this->collection->create();
		$featured->addAttributeToFilter('is_featured', array('eq' => 1))->setPageSize($quantity)->load();
		return $featured;
	}
	public function getProductById($id) {
		return $this->_productRepository->getById($id);
	}
}