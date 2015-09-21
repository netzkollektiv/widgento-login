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

class Widgento_Login_Adminhtml_LogController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customer/widgentologin')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Customers'), Mage::helper('adminhtml')->__('Customers'))
        ;

        return $this;
    }

    public function indexAction()
    {
        $this->loadLayout()
            ->renderLayout();
    }

    public function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('customer/widgentologin/log');
    }

    public function gridAction()
    {
        $this->loadLayout(false);
        $this->renderLayout();
    }

    public function clearAction()
    {
        Mage::getModel('widgentologin/login')->truncate();

        Mage::getSingleton('adminhtml/session')->addSuccess('Log has been cleared successfully.');

        $this->_redirect('*/*/index');
    }
}
