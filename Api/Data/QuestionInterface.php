<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\QA\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    // const QUESTION_ID      = 'qa_id';
    // const NAME = "name";
    // const EMAIL         = 'email';
    // const QUESTION       = 'question';
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT   = 'updated_at';
    // const STATUS     = 'status';
    // const ANSWER       = 'answer';
    // const STORE_ID = 'store_id';
    // const USER_ID   = 'user_id';
    // const IMAGE_PATH     = 'image_path'; 
    // const PRODUCT_ID = "product_id";
    /**#@-*/

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getEmail();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getQuestion();
    /**
     * Undocumented function
     *
     * @return int
     */
    public function getProductId();
    /**
     * Undocumented function
     *
     * @return int
     */
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getAnswer();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getCreatedAt();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getUpdatedAt();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getImagePath();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getQaId();
     
    /**
     * Undocumented function
     *
     * @param string $name
     * @return null
     */
    public function setName($name);
    /**
     * Undocumented function
     *
     * @param string $email
     * @return null
     */
    public function setEmail($email);
    /**
     * Undocumented function
     *
     * @param string $question
     * @return null
     */
    public function setQuestion($question);
    /**
     * Undocumented function
     *
     * @param string $answer
     * @return null
     */
    public function setAnswer($answer);
    /**
     * Undocumented function
     *
     * @param int $productId
     * @return null
     */
    public function setProductId($productId);

}
