<?php
/**
 * Authors extension for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Authors admin controller
 *
 * @category   Authors
 * @package     Yireo_Authors
 */
class Yireo_Authors_AuthorsController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Common method
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customer/authors')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Customers'), Mage::helper('adminhtml')->__('Customers'))
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Authorss'), Mage::helper('adminhtml')->__('Authorss'))
        ;
        return $this;
    }

    /**
     * Overview page
     */
    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('authors/backend_overview'))
            ->renderLayout();
    }

    /**
     * Edit page
     */
    public function editAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('authors/backend_edit'))
            ->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction()
    {
        $author = $this->getRequest()->getPost('author');

        if (!empty($author)) { 

            $item = Mage::getModel('authors/author');
            foreach($author as $name => $value) {
                $item->setData($name, $value);
            }

            $item->save();
            Mage::getModel('core/session')->addSuccess('Successfully saved author');
        }

        if($this->getRequest()->getParam('back') == 'edit') {
            $this->_redirect('adminhtml/authors/edit', array('id' => $item_id));
        } else {
            $this->_redirect('adminhtml/authors/index');
        }
        return;
    }
}
