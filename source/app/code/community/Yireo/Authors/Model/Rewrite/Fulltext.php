<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Authors_Model_Rewrite_Fulltext extends Mage_CatalogSearch_Model_Mysql4_Fulltext
{
    protected function _getAttributeValue($attributeId, $value, $storeId)
    {
        $value = parent::_getAttributeValue($attributeId, $value, $storeId);
        $attribute = $this->_getSearchableAttribute($attributeId);
        if ($attribute->getIsSearchable() && $attribute->getName() == 'author') {

            if(preg_match('/^([0-9\,]+)$/', $value)) {
                $authors = Mage::helper('authors')->getAuthors($value);
                if(!empty($authors)) {
                    $value = Mage::helper('authors')->authorsToString($authors, false);
                }
            }
        }

        return $value;
    }
}
