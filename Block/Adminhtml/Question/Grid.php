<?php
namespace AHT\QA\Block\Adminhtml\Question;
use Magento\Backend\Block\Widget\Grid as WidgetGrid;
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /* @var \AHT\HelloWorld\Model\Resource\Subscription\Collection
    */
    protected $_questionCollection;
    /*
    @param \Magento\Backend\Block\Template\Context $context
    @param \Magento\Backend\Helper\Data $backendHelper
    @param
    \AHT\HelloWorld\Model\ResourceModel\Subscription\Collection
    $subscriptionCollection
    @param array $data
    */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \AHT\QA\Model\ResourceModel\Question\Collection $questionCollection,
        array $data = []
    ) {
        $this->_questionCollection = $questionCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Questions Found'));
    }
    /*
    Initialize the subscription collection

    @return WidgetGrid
    */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_questionCollection);
        return parent::_prepareCollection();
    }

    /*
    Prepare grid columns
    @return $this
    */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'qa_id',
            [
            'header' => __('ID'),
            'index' => 'qa_id'
            ]
            );
            $this->addColumn(
            'Name',
            [
            'header' => __('Name'),
            'index' => 'name'
            ]
            );
            $this->addColumn(
            'email',
            [
            'header' => __('Email'),
            'index' => 'email'
            ]
            );
            $this->addColumn(
            'question',
            [
            'header' => __('Question'),
            'index' => 'question'
            ]
            );
            $this->addColumn(
            'created_at',
            [
            'header' => __('Created At'),
            'index' => 'created_at'
            ]
            );
            $this->addColumn(
            'updated_at',
            [
            'header' => __('Updated At'),
            'index' => 'updated_at'
            ]
            );
            $this->addColumn(
            'product_id',
            [
            'header' => __('Product ID'),
            'index' => 'product_id'
            ]
            );
            $this->addColumn(
            'user_id',
            [
            'header' => __('User ID'),
            'index' => 'user_id'
            ]
            );
            $this->addColumn(
            'store_id',
            [
            'header' => __('Store ID'),
            'index' => 'store_id'
            ]
            );
            $this->addColumn(
            'answer',
            [
            'header' => __('Answer'),
            'index' => 'answer'
            ]
            );
            $this->addColumn(
            'status',
            [
            'header' => __('Status'),
            'index' => 'status',
            'frame_callback' => [$this, 'decorateStatus']
            ]
        );
        return $this;
    }
    public function decorateStatus($value)
    {
        $class = '';
        switch ($value) {
        case 'pending':
        $class = 'grid-severity-minor';
        break;
        case 'approved':
        $class = 'grid-severity-notice';
        break;
        case 'declined':default:
        $class = 'grid-severity-critical';
        break;
        }
        return '<span class="' . $class . '"><span>' . $value .
       '</span></span>';
    }
}