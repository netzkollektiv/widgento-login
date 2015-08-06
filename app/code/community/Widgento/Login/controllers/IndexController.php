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
 
class Widgento_Login_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $hash  = $this->getRequest()->getParam('id');
        $login = Mage::getModel('widgentologin/login')->load($hash, 'login_hash');

        $login->truncate();

        if ($login->getCustomerId())
        {
            /* @var $customerSession Mage_Customer_Model_Session */
            $customerSession = Mage::getSingleton('customer/session');

            if (method_exists($customerSession, 'renewSession'))
            {
                $customerSession->renewSession();
            }
            else // for 1.4
            {
                $customerSession->logout();
            }
            
            $customerSession->loginById($login->getCustomerId());

            return $this->_redirect('customer/account/');
        }

        return $this->_redirect('');
    }
}
