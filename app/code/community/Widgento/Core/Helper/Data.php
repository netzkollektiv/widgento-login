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

class Widgento_Core_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_FEED_URL_PATH = 'widgentocore/newsletter/feed_url';

    public function getFeedUrl()
    {
        $url = Mage::getStoreConfig(self::XML_FEED_URL_PATH);

        return  $url.'?s='.urlencode(Mage::getStoreConfig('web/unsecure/base_url'));
    }
}
