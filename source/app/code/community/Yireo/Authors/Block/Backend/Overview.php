<?php
/**
 * Authors extension for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Authors_Block_Backend_Overview extends Mage_Adminhtml_Block_Widget_Container
{
    /*
     * Constructor method
     */
    public function _construct()
    {
        $this->setTemplate('authors/overview.phtml');
        parent::_construct();
    }

    protected function _prepareLayout()
    {
        $this->setChild('grid', $this->getLayout()
            ->createBlock('authors/backend_overview_grid', 'authors.grid')
            ->setSaveParametersInSession(true)
        );
        return parent::_prepareLayout();
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

    /*
     * Helper to return the header of this page
     */
    public function getHeader($title = null)
    {
        return 'Authors - '.$this->__($title);
    }
}
