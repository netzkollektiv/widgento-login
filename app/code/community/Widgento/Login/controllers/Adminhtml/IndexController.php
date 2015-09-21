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

class Widgento_Login_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $customerId = $this->getRequest()->getParam('id');
        $customer   = Mage::getModel('customer/customer')->load($customerId);

        if (!Mage::helper('widgentologin')->isLoginAllowed($customerId) || !$customer->getId())
        {
            return $this->_redirect('admin/');
        }

        $hash = md5(uniqid(mt_rand(), true));
        Mage::getModel('widgentologin/login')
            ->setLoginHash($hash)
            ->setCustomerId($customerId)
            ->setAdminId(Mage::getSingleton('admin/session')->getUser()->getId())
            ->setCreatedAt(now())
            ->setIsActive(1)
            ->save();

        return $this->_redirect('widgentologin/', array(
        	'id'     => $hash, 
        	'_store' => Mage::helper('widgentologin')->getCustomerStoreId($customer->getId()), 
            ));
    }

    public function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('customer/widgentologin');
    }
}
