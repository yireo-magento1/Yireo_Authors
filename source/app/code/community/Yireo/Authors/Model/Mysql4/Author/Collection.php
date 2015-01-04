<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Authors item resource collection
 */
class Yireo_Authors_Model_Mysql4_Author_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('authors/author');
    }
}
