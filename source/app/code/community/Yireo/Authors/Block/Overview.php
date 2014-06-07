<?php
/**
 * Authors extension for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Authors_Block_Overview extends Mage_Core_Block_Template
{
    public function getTitle()
    {
        $author_id = (int)$this->getRequest()->getParam('id', 0);
        $author = Mage::getModel('authors/author')->load($author_id);
        return $this->__('Books of author %s', $author->getFullName());
    }
}
