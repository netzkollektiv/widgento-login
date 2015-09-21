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

class Widgento_Login_Model_Mysql4_Login_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected $_storeId;

    public function _construct()
    {
        $this->_init('widgentologin/login');
    }

    /**
     * @param int $storeId
     * @return Widgento_Login_Model_Mysql4_Login_Collection
     */
    public function setStoreId($storeId)
    {
        $this->_storeId = $storeId;

        return $this;
    }

    /**
     * @return Widgento_Login_Model_Mysql4_Login_Collection
     */
    public function joinCustomers()
    {
        $this->getSelect()
            ->joinLeft(array('customer' => $this->getTable('customer/entity')), 'customer.entity_id = main_table.customer_id', array('customer.email' => 'email'));

        return $this;
    }

    /**
     * @return Widgento_Login_Model_Mysql4_Login_Collection
     */
    public function prepareColumns()
    {
        $this->getSelect()
            ->columns(array('main_table.store_id' => 'store_id'));

        return $this;
    }

    /**
     * @return Widgento_Login_Model_Mysql4_Login_Collection
     */
    public function joinAdmins()
    {
        $this->getSelect()
            ->joinLeft(array('admin' => $this->getTable('admin/user')), 'admin.user_id = main_table.admin_id', array('username' => 'admin.username'));

        return $this;
    }
}
