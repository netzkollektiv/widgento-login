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

class Widgento_Login_Model_Mysql4_Login extends Mage_Core_Model_Mysql4_Abstract
{
    /**
    * Initialize resource
    */
    protected function _construct()
    {
        $this->_init('widgentologin/login', 'login_id');
    }

    public function truncate()
    {
        $db = $this->_getWriteAdapter();
        if (method_exists($db, 'truncateTable'))
        {
            $db->truncateTable($this->getMainTable());
        }
        else
        {
            $db->truncate($this->getMainTable());
        }
    }
}