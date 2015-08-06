<?php

/**
 * Widgento_Core
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Widgento
 * @package    Widgento_Core
 * @author     Yury Ksenevich <info@widgento.com>
 * @copyright  Copyright (c) 2012-2014 Yury Ksenevich p.e.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */


?><?php

class Widgento_Core_Model_Feed extends Mage_AdminNotification_Model_Feed
{
    /**
     * @var Widgento_Core_Helper_Data
     */
    private $_helper;

    public function _construct()
    {
        $this->_helper = Mage::helper('widgentocore');
    }

    /**
     * Retrieve feed url
     *
     * @return string
     */
    public function getFeedUrl()
    {
        if (is_null($this->_feedUrl))
        {
            $this->_feedUrl = $this->_helper->getFeedUrl();
        }

        return $this->_feedUrl;
    }

    /**
     * Retrieve Last update time
     *
     * @return int
     */
    public function getLastUpdate()
    {
        return Mage::app()->loadCache('widgentocore_newsletter_lastcheck');
    }

    /**
     * Set last update time (now)
     *
     * @return Mage_AdminNotification_Model_Feed
     */
    public function setLastUpdate()
    {
        Mage::app()->saveCache(time(), 'widgentocore_newsletter_lastcheck');

        return $this;
    }
}
