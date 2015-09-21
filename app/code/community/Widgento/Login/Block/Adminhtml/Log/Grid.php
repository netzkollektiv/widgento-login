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

class Widgento_Login_Block_Adminhtml_Log_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('widgentologin_log_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $logs = Mage::getModel('widgentologin/login')->getCollection()
            ->prepareColumns()
            ->joinCustomers()
            ->joinAdmins();

        $this->setCollection($logs);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('created_at', array(
            'header' => Mage::helper('widgentologin')->__('Login Date'),
            'index' => 'created_at',
            'type' => 'datetime',
            'width' => '160px',
        ));

        $this->addColumn('username', array(
            'header'=> Mage::helper('widgentologin')->__('Admin Username'),
            'type'  => 'text',
            'index' => 'username',
        ));

        $this->addColumn('store_id', array(
            'header'          => Mage::helper('widgentologin')->__('Login Store'),
            'index'           => 'main_table.store_id',
            'type'            => 'store',
            'store_view'      => true,
            'display_deleted' => true,
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('widgentologin')->__('Customer Email'),
            'index' => 'customer.email',
        ));

        if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
            $this->addColumn('action',
                array(
                    'header'    => Mage::helper('sales')->__('Action'),
                    'width'     => '100px',
                    'type'      => 'action',
                    'getter'    => 'getCustomerId',
                    'actions'   => array(
                        array(
                            'caption' => Mage::helper('widgentologin')->__('View Customer'),
                            'url'     => array('base'=>'adminhtml/customer/edit'),
                            'field'   => 'id'
                        )
                    ),
                    'filter'    => false,
                    'sortable'  => false,
                    'index'     => 'stores',
                    'is_system' => true,
                ));
        }

        return parent::_prepareColumns();
    }

    public function getRowUrl($item)
    {
        return $this->getUrl('adminhtml/customer/edit', array('id' => $item->getCustomerId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}
