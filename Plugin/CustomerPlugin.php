<?php

namespace AHT\QA\Plugin;

class CustomerPlugin
{
    public function beforeAuthenticate(\Magento\Customer\Api\AccountManagementInterface $subject, $username, $password)
    {
        $username = "roni_cost@example.com";
        $password = "roni_cost3@example.com";
        return [$username, $password];
    }

}