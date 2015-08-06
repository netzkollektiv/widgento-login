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
 * @copyright  Copyright (c) 2012-2014 Yury Ksenevich p.e.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */


?><?php

class Widgento_Login_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        /* @var $adminSession Mage_Admin_Model_Session */
        $adminSession = Mage::getSingleton('admin/session');
        $customerId   = $this->getRequest()->getParam('id');
        $customer     = Mage::getModel('customer/customer')->load($customerId);

        if (!$adminSession->isAllowed('customer/login') || !$customer->getId()) 
        {
            return $this->_redirect('admin/');
        }

        $hash  = md5(uniqid(mt_rand(), true));
        $login = Mage::getModel('widgentologin/login')
            ->setLoginHash($hash)
            ->setCustomerId($customerId)
            ->save();

        return $this->_redirect('widgentologin/', array(
        	'id'     => $hash, 
        	'_store' => Mage::helper('widgentologin')->getCustomerStoreId($customer->getId()), 
            ));
    }
}
