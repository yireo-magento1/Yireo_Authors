<?php
/**
 * Yireo Authors for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Class for block "authors_overview_products"
 */
class Yireo_Authors_Block_Overview_Products extends Mage_Catalog_Block_Product_List
{
    /**
     * Page title
     */

    /**
     * Get the products
     *
     * @return array
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {

            $author_id = (int)$this->getRequest()->getParam('id', 0);
            if($author_id > 0) {

                $collection = Mage::getResourceModel('catalog/product_collection');
                Mage::getModel('catalog/layer')->prepareProductCollection($collection);

                $collection->addAttributeToSelect('*')
                    ->addFieldToFilter(array(
                        array('attribute'=>'author','eq'=>$author_id),
                        array('attribute'=>'author','like'=>$author_id.',%'),           
                        array('attribute'=>'author','like'=>'%,'.$author_id),           
                        array('attribute'=>'author','like'=>'%,'.$author_id.',%'),           
                    ))
                ;

                $this->_productCollection = $collection;
            }
        }
        return $this->_productCollection;
    }
}
