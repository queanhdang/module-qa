<?php

namespace AHT\QA\Plugin;

class ProductPlugin
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + 100 ;
    }
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result . "( Nhan dip dac biet, toi xin tang gia moi thu 100 )" ;
    }
}