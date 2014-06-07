<?php
/**
 * Authors extension for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/*
 * Class for block "authors_edit"
 */
class Yireo_Authors_Block_Backend_Edit extends Mage_Adminhtml_Block_Widget
{
    /*
     * Constructor method
     *
     * @return null
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('authors/edit.phtml');
        $author = Mage::getModel('authors/author')->load($this->getRequest()->getParam('id', 0));
        $this->setAuthor($author);
    }

    /*
     * Helper to return the header of this page
     *
     * @return string
     */
    public function getHeader($title = null)
    {
        return 'Authors - '.$this->__($title);
    }

    /**
     * Return the save URL
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return Mage::getModel('adminhtml/url')->getUrl('*/*/save');
    }

    /**
     * Return the back URL
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    public function getAppliedProducts()
    {
        $author_id = $this->getAuthor()->getAuthorId();
        if($author_id > 0) {
            $products = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter(array(
                    array('attribute'=>'author','like'=>$author_id),
                    array('attribute'=>'author','like'=>$author_id.',%'),           
                    array('attribute'=>'author','like'=>'%,'.$author_id),           
                    array('attribute'=>'author','like'=>'%,'.$author_id.',%'),           
                ))
            ;

            return $products;
        }
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->setChild('save_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('catalog')->__('Save'),
                    'onclick' => 'authorsForm.submit();',
                    'class' => 'save'
                ))
        );

        $this->setChild('back_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('catalog')->__('Back'),
                    'onclick' => 'setLocation(\''.$this->getBackUrl().'\')',
                    'class' => 'back'
                ))
        );

        return parent::_toHtml();
    }
}
