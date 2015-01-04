<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Authors_Model_Source_Author extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = Mage::getSingleton('page/source_layout')->toOptionArray();
            array_unshift($this->_options, array('value'=>'', 'label'=>Mage::helper('catalog')->__('No layout updates')));
        }
        return $this->_options;
    }

    public function toOptionArray()
    {
        return $this->getAllOptions();
    }
}
