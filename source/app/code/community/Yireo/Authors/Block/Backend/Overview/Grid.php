<?php
/**
 * Authors extension for Magento 
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Authors_Block_Backend_Overview_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

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

    protected function _prepareLayout()
    {
        $this->setChild('new_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('adminhtml')->__('New'),
                    'onclick'   => 'setLocation(\''.$this->getNewUrl().'\')',
                    'class'   => 'task'
                ))
        );

        return parent::_prepareLayout();
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('authors/author')->getCollection();

        $values = Mage::helper('modal')->csvToArray($this->getRequest()->getParam('value'));

        $filter = $this->getParam($this->getVarNameFilter(), null);
        $data = $this->helper('adminhtml')->prepareFilterString($filter);
        if(isset($data['checkid']) && $data['checkid'] == 1) {
            $collection->addFieldToFilter('author_id', array('in' => $values));
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $values = Mage::helper('modal')->csvToArray($this->getRequest()->getParam('value'));
        
        $this->addColumn('checkid', array(
            'header'=> Mage::helper('authors')->__('Select'),
            'name' => 'checkid',
            'field_name' => 'checkid[]',
            'type' => 'checkbox',
            'values' => $values,
            'index' => 'author_id',
        ));

        $this->addColumn('author_id', array(
            'header'=> Mage::helper('authors')->__('Author ID'),
            'width' => '50px',
            'index' => 'author_id',
            'type' => 'number',
        ));

        $this->addColumn('full_name', array(
            'header'=> Mage::helper('authors')->__('Full Name'),
            'index' => 'full_name',
            'type' => 'text',
        ));

        $this->addColumn('first_name', array(
            'header'=> Mage::helper('authors')->__('First Name'),
            'index' => 'first_name',
            'type' => 'text',
        ));

        $this->addColumn('first_letters', array(
            'header'=> Mage::helper('authors')->__('First Letters'),
            'index' => 'first_letters',
            'type' => 'text',
        ));

        $this->addColumn('prefix', array(
            'header'=> Mage::helper('authors')->__('Prefix'),
            'index' => 'prefix',
            'type' => 'text',
        ));

        $this->addColumn('last_name', array(
            'header'=> Mage::helper('authors')->__('Last Name'),
            'index' => 'last_name',
            'type' => 'text',
        ));

        $this->addColumn('actions', array(
            'header'=> Mage::helper('authors')->__('Action'),
            'type' => 'action',
            'getter'     => 'getId',
            'actions'   => array(
                array(
                    'caption' => Mage::helper('authors')->__('Edit'),
                    'url' => array('base'=>'*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter'    => false,
            'sortable'  => false,
        ));

        return parent::_prepareColumns();
    }

    public function getNewUrl()
    {
        return $this->getUrl('*/*/edit');
    }

    public function getNewButtonHtml()
    {
        return $this->getChildHtml('new_button');
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'store'=>$this->getRequest()->getParam('store'),
            'id'=>$row->getId())
        );
    }

    public function getMainButtonsHtml()
    {
        $html = parent::getMainButtonsHtml();
        $html = $html . $this->getNewButtonHtml();
        return $html;
    }
}
