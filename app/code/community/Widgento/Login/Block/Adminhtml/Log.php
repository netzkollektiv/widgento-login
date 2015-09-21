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

class Widgento_Login_Block_Adminhtml_Log extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup     = 'widgentologin';
        $this->_controller     = 'adminhtml_log';
        $this->_headerText     = Mage::helper('widgentologin')->__('Login as Customer Logs');

        parent::__construct();

        $this->_removeButton('add');
        $this->_addButton('flush', array(
            'label'     => Mage::helper('widgentologin')->__('Clear Logs'),
            'onclick'   => 'setLocation(\'' . $this->getUrl('widgentologinadmin/log/clear') .'\')',
            'class'     => 'delete',
        ));

    }
}
