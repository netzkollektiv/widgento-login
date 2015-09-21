<?php

/**
 * Widgento_Login
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Widgento
 * @package    Widgento_Login
 * @author     Yury Ksenevich <info@widgento.com>
 * @copyright  Copyright (c) 2012-2015 Yury Ksenevich p.e.
 * @license    http://www.widgento.com/customer-service Widgento Modules License
 */


?><?php

class Widgento_Login_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getCustomerStoreId($customerId)
    {
        if (!$customerId)
        {
            return false;
        }
    
        $customer = Mage::getModel('customer/customer')->load($customerId);

        if ($customer->getStoreId())
        {
            $customerStore = Mage::app()->getStore($customer->getStoreId());

            if ($customerStore->getId() && $customerStore->getIsActive())
            {
                return $customer->getStoreId();
            }
        }
    
        if ($customer->getWebsiteId())
        {
            $customerWebsite = Mage::app()->getWebsite($customer->getWebsiteId());
    
            foreach ($customerWebsite->getStores() as $websiteStore)
            {
                if ($websiteStore->getIsActive())
                {
                    return $websiteStore->getId();
                }
            }
        }
    
        if (0 == Mage::getStoreConfig('customer/account_share/scope'))
        {
            return Mage::app()->getDefaultStoreView()->getId();
        }
    }

    public function isSaveLogs()
    {
        return Mage::getStoreConfig('widgentologin/general/save_logs');
    }

    public function isOrderViewDisplayButton()
    {
        return Mage::getStoreConfig('widgentologin/general/order_view_display');
    }

    public function isLoginAllowed($customerId) {
        /* @var $adminSession Mage_Admin_Model_Session */
        $adminSession = Mage::getSingleton('admin/session');
        $transport    = new Varien_Object(array('disable' => false));
        Mage::dispatchEvent('widgentologin_disable', array(
            'transport'   => $transport,
            'customer_id' => $customerId,
        ));

        return ($adminSession->isAllowed('customer/widgentologin') || $transport->getDisable());
    }
}
