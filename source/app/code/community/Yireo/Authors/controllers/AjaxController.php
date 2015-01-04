<?php
/**
 * Authors extension for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Authors admin controller
 *
 * @category   Authors
 * @package     Yireo_Authors
 */
class Yireo_Authors_AjaxController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Common method
     */
    protected function showBlock($block)
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock($block));
        $this->renderLayout();
        return $this;
    }

    /**
     * Overview page
     */
    public function indexAction()
    {
        $this->showBlock('authors/backend_overview');
    }

    /**
     * New page
     */
    public function newAction()
    {
        $this->showBlock('authors/backend_edit');
    }

    /**
     * Edit page
     */
    public function editAction()
    {
        $this->showBlock('authors/backend_edit');
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
                if($name == 'author_id' && !$value > 0) continue;
                $item->setData($name, $value);
            }

            $item->save();
            Mage::getModel('core/session')->addSuccess('Successfully saved author');
        }

        if($this->getRequest()->getParam('back') == 'edit') {
            $this->_redirect('*/*/edit', array('id' => $item_id));
        } else {
            $this->_redirect('*/*/index');
        }
        return;
    }
}
