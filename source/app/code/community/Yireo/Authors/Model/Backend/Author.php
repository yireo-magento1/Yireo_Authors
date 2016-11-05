<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

require_once 'Yireo/Modal/Lib/Element/Modal.php';
class Yireo_Authors_Model_Backend_Author extends Yireo_Modal_Model_Backend_Abstract
{
    /**
    public function afterLoad($object)
    {
        parent::afterLoad($object);
    }
    */

    static public function isStatic()
    {
        return false;
    }
}
