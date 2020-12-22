<?php
namespace AHT\QA\Model;

use AHT\QA\Model\QuestionFactory;
use AHT\QA\Model\ResourceModel\Question;
use AHT\QA\Api\Data\QuestionInterface;

class QuestionRepository implements \AHT\QA\Api\QuestionRepositoryInterface {

    protected $_questionFactory;
    protected $_questionResource;
    protected $_request;
    public function __construct(
        QuestionFactory $questionFactory,
        Question $questionResource,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_questionFactory = $questionFactory;
        $this->_questionResource = $questionResource;
        $this->_request = $request;
    }
   
    /**
     * Undocumented function
     *
     * @param [type] $qaId
     * @return void
     */
    public function get($qaId) {
        $id = (int) $qaId;
        $model = $this->_questionFactory->create();
        $this->_questionResource->load($model, $id);
        return $model->getData();
    }

    /**
     * Undocumented function
     *
     * @return null
     */
    public function getList() {
        // die('hoho');
        $collection = $this->_questionFactory->create()->getCollection();
        return $collection->getData();
    }

    /**
     * Save Block data
     *
     * 
     * @return \AHT\QA\Model\Question
     */
    public function save(QuestionInterface $qa) {

        $this->_questionResource->save($qa);
        return $qa->getData();
    }
    
}