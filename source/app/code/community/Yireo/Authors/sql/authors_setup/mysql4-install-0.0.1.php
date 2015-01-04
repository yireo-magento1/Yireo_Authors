<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer = $this;
$installer->startSetup();

$installer->addAttribute('catalog_product', 'author', array(
    'type'              => 'varchar',
    'backend'           => 'authors/backend_author',
    'frontend'          => 'authors/frontend_author',
    'label'             => 'Author',
    'input'             => 'modal',
    'class'             => '',
    'source'            => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => false,
    'default'           => '',
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'unique'            => true,
    'apply_to'          => 'simple,configurable,virtual,bundle,grouped',
    'is_configurable'   => false
));

$installer->run("
CREATE TABLE IF NOT EXISTS {$this->getTable('authors_author')} (
  `author_id` int(11) NOT NULL auto_increment,
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `first_letters` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");

$installer->endSetup();
