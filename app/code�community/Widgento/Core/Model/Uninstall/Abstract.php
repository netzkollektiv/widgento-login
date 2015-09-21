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

abstract class Widgento_Core_Model_Uninstall_Abstract
{
    /**
     * @var Mage_Eav_Model_Entity_Setup
     */
    protected $_setup;

    public function __construct()
    {
        $this->_setup = new Mage_Eav_Model_Entity_Setup('core_setup');
    }

    abstract function run();

    final function uninstall(Varien_Event_Observer $observer)
    {
        $module = $observer->getEvent()->getModule();

        if (0 !== strpos(get_class($this), $module))
        {
            return false;
        }

        $this->run();

        $manifestPath = str_replace('_', '/', $module).'/etc/manifest.xml';

        foreach (explode(PS, get_include_path()) as $includePath)
        {
            if (file_exists($includePath.DS.$manifestPath))
            {
                $manifestPath = $includePath.DS.$manifestPath;
                break;
            }
        }

        if (!file_exists($manifestPath))
        {
            throw new Exception('Manifest path "'.$manifestPath.'" does not exist');
        }

        $manifestXml = new SimpleXMLElement($manifestPath, null, true);
        $paths       = $manifestXml->xpath('/manifest/'.$module.'/paths/path');
        $file        = new Varien_Io_File();

        foreach ($paths as $path)
        {
            $path = BP.DS.$path;
            if (file_exists($path))
            {
                if (is_dir($path))
                {
                    $file->rmdir($path, true);
                }
                else
                {
                    $file->rm($path);
                }
            }
        }

        $this->_removeResources($module);
    }

    protected function _removeResources($module)
    {
        $modulePreffix = preg_replace('|[^a-z]|', '', strtolower($module));

        $this->_setup->getConnection()->delete($this->_setup->getTable('core/resource'), 'code LIKE "'.$modulePreffix.'%"');
    }
}
