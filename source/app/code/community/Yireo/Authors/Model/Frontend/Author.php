<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/*
 * Ugly hack to require the input-type "modal" prematurely
 */
require_once 'Yireo/Modal/Lib/Element/Modal.php';

/*
 * Ugly hack to set the right data inside the modal-box
 */
Mage::helper('modal')->setData( 'authors/ajax/index', 950, 700 );

/*
 * Class that defines the EAV attribute "author"
 */
class Yireo_Authors_Model_Frontend_Author extends Mage_Eav_Model_Entity_Attribute_Frontend_Abstract
{
    protected $authors = array();
    protected $original_value = null;

    public function getLabel()
    {
        if(!empty($this->authors) && count($this->authors) > 1) {
            return Mage::helper('core')->__('Authors');
        }
                
        return Mage::helper('core')->__('Author');
    }

    public function getValue(Varien_Object $object)
    {
        $value = parent::getValue($object);

        if(preg_match('/^([0-9\,]+)$/', $value)) {

            $this->authors = Mage::helper('authors')->getAuthors($value);
            if(!empty($this->authors)) {
                $value = Mage::helper('authors')->authorsToString($this->authors);
            } else {
                $value = Mage::helper('core')->__('Unknown');
            }
        }

        return $value;
    }
}
