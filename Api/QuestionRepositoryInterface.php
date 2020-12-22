<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\QA\Api;

/**
 * @api
 * @since 100.0.2
 */
interface QuestionRepositoryInterface
{
    /**
     * Undocumented function
     * @return null
     */

    public function getList();

   /**
     * Undocumented function
     *
     * @param string $qaId
     * @return null
     */
    public function get($qaId);

    /**
     * Undocumented function
     * 
     *
     * @return \AHT\QA\Model\Question
     */
    public function save(\AHT\QA\Api\Data\QuestionInterface $qa);




}
