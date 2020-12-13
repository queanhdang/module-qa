<?php

namespace AHT\QA\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	protected $_questionFactory;

	public function __construct(\AHT\QA\Model\QuestionFactory $questionFactory)
	{
		$this->_questionFactory = $questionFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		// $data = [
        //     'name'         => "Dang Que Anh",
        //     'email'        => "rintohsaka1998@gmail.com",
		// 	'question'      => 'test question?'
		// ];
		// $post = $this->_questionFactory->create();
		// $post->addData($data)->save();
	}
}