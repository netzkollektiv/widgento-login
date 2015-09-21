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

class Widgento_Core_Block_System_Extensions  extends Mage_Adminhtml_Block_System_Config_Form_Fieldset {
    protected $_dummyElement;
    protected $fieldRenderer;
    protected $_values;

    public static $extensionPrefixes = array('Widgento_');
    public static $hiddenExtensions  = array('Widgento_Core');

    public function render(Varien_Data_Form_Element_Abstract $element) {
        $html    = $this->_getHeaderHtml($element);
        $modules = array_keys((array)Mage::getConfig()->getNode('modules')->children());
        sort($modules);

        foreach ($modules as $moduleName) {
            if (in_array($moduleName, self::$hiddenExtensions)) {
                continue;
            }

            foreach (self::$extensionPrefixes as $prefix) {
                if (0 === strpos($moduleName, $prefix)) {
                    $html.= $this->_getFieldHtml($element, $moduleName);
                    continue 2;
                }
            }
        }

        $html .= $this->_getFooterHtml($element);

        return $html;
    }

    protected function getFieldRenderer() {
        if (empty($this->fieldRenderer)) {
            $this->fieldRenderer = Mage::getBlockSingleton('adminhtml/system_config_form_field');
        }

        return $this->fieldRenderer;
    }

    protected function _getFieldHtml($fieldset, $moduleCode) {
        $currentVer = Mage::getConfig()->getModuleConfig($moduleCode)->version;
        if (!$currentVer) {
            return false;
        }

        $field = $fieldset->addField($moduleCode, 'label', array(
            'name'  => 'dummy',
            'label' => $moduleCode,
            'value' => $currentVer,
        ))->setRenderer($this->getFieldRenderer());

        return $field->toHtml();
    }
}
