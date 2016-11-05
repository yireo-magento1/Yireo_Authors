<?php

/**
 * Authors extension for Magento
 *
 * @package     Yireo_Authors
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */
class Yireo_Authors_Block_Backend_Overview_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('authorsGrid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setRowClickCallback();
        $this->setUseAjax(false);
        //$this->setPagerVisibility(false);
        //$this->setDefaultLimit(0);
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $buttonData = array(
            'label' => Mage::helper('adminhtml')->__('New'),
            'onclick' => 'setLocation(\'' . $this->getNewUrl() . '\')',
            'class' => 'task'
        );

        $buttonBlock = $this->getLayout()->createBlock('adminhtml/widget_button');
        $buttonBlock->setData($buttonData);

        $this->setChild('new_button', $buttonBlock);

        return parent::_prepareLayout();
    }

    /**
     * @return Yireo_Authors_Model_Mysql4_Author_Collection
     * @throws Exception
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('authors/author')->getCollection();

        /** @var Yireo_Modal_Helper_Data $modalHelper */
        $modalHelper = Mage::helper('modal');
        $values = $modalHelper->csvToArray($this->getRequest()->getParam('value'));

        $filter = $this->getParam($this->getVarNameFilter(), null);
        $data = $this->helper('adminhtml')->prepareFilterString($filter);
        if (isset($data['checkid']) && $data['checkid'] == 1) {
            $collection->addFieldToFilter('author_id', array('in' => $values));
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $values = Mage::helper('modal')->csvToArray($this->getRequest()->getParam('value'));

        $this->addColumn('checkid', array(
            'header' => Mage::helper('authors')->__('Select'),
            'name' => 'checkid',
            'field_name' => 'checkid[]',
            'type' => 'checkbox',
            'values' => $values,
            'index' => 'author_id',
        ));

        $this->addColumn('author_id', array(
            'header' => Mage::helper('authors')->__('Author ID'),
            'width' => '50px',
            'index' => 'author_id',
            'type' => 'number',
        ));

        $this->addColumn('full_name', array(
            'header' => Mage::helper('authors')->__('Full Name'),
            'index' => 'full_name',
            'type' => 'text',
        ));

        $this->addColumn('first_name', array(
            'header' => Mage::helper('authors')->__('First Name'),
            'index' => 'first_name',
            'type' => 'text',
        ));

        $this->addColumn('first_letters', array(
            'header' => Mage::helper('authors')->__('First Letters'),
            'index' => 'first_letters',
            'type' => 'text',
        ));

        $this->addColumn('prefix', array(
            'header' => Mage::helper('authors')->__('Prefix'),
            'index' => 'prefix',
            'type' => 'text',
        ));

        $this->addColumn('last_name', array(
            'header' => Mage::helper('authors')->__('Last Name'),
            'index' => 'last_name',
            'type' => 'text',
        ));

        $this->addColumn('actions', array(
            'header' => Mage::helper('authors')->__('Action'),
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('authors')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
        ));

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getNewUrl()
    {
        return $this->getUrl('*/*/edit');
    }

    /**
     * @return string
     */
    public function getNewButtonHtml()
    {
        return $this->getChildHtml('new_button');
    }

    /**
     * @param $row
     *
     * @return string
     * @throws Exception
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
                'store' => $this->getRequest()->getParam('store'),
                'id' => $row->getId())
        );
    }

    /**
     * @return string
     */
    public function getMainButtonsHtml()
    {
        $html = parent::getMainButtonsHtml();
        $html = $html . $this->getNewButtonHtml();
        return $html;
    }
}
