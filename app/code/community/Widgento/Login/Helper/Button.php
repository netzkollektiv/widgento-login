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

class Widgento_Login_Helper_Button extends Mage_Core_Helper_Abstract
{
    

    public function getButtonData()
    {
        return array(
            'label'   => $this->__('Log in customer'), 
            'onclick' => 'window.open(\''.Mage::getModel('adminhtml/url')->getUrl('widgentologinadmin/', array('id' => $this->_getCustomerId())).'\', \'customer\');', 
            );
    }

    protected function _getCustomerId()
    {
        $customerId      = 0;
        $currentCustomer = Mage::registry('current_customer');
        $currentOrder    = Mage::registry('current_order');
        
        if ($currentCustomer instanceof Mage_Customer_Model_Customer)
        {
            $customerId = $currentCustomer->getId();
        }

        if ($currentOrder instanceof Mage_Sales_Model_Order)
        {
            $customerId = $currentOrder->getCustomerId();
        }

        return $customerId;
    }

    public function getButtonArea()
    {
        if (!Mage::helper('widgentologin')->isLoginAllowed($this->_getCustomerId()) || !Mage::helper('widgentologin')->getCustomerStoreId($this->_getCustomerId()))
        {
            return 'hidden';
        }

        return 'header';
    }
}