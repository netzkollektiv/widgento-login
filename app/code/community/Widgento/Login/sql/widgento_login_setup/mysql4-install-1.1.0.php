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

/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run('

DROP TABLE IF EXISTS `'.$installer->getTable('widgentologin/login_deprecated').'`;

DELETE FROM `'.$installer->getTable('core/resource').'`
WHERE code LIKE "spadar%";

');

$installer->run('

DROP TABLE IF EXISTS `'.$installer->getTable('widgentologin/login').'`;

CREATE TABLE `'.$installer->getTable('widgentologin/login').'` (
  `login_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login_hash` CHAR(32)  NOT NULL,
  `customer_id` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`login_Id`)
) ENGINE = InnoDB;

');

$installer->run('

ALTER TABLE `'.$installer->getTable('widgentologin/login').'`
  ADD COLUMN `created_at` TIMESTAMP NOT NULL
, ADD COLUMN `is_active` TINYINT UNSIGNED NOT NULL DEFAULT 0
, ADD COLUMN `admin_id` SMALLINT UNSIGNED NOT NULL
, ADD COLUMN `store_id` SMALLINT UNSIGNED NULL
;

');

$installer->endSetup();
