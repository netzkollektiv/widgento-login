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

class Widgento_Core_Adminhtml_RewriteController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this
            ->loadLayout()
            ->renderLayout();
    }
}
