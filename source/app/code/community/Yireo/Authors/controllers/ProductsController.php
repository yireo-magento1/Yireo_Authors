<?php
/**
 * Yireo Authors
 *
 * @package     Yireo_Authors
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Authors default controller
 */
class Yireo_Authors_ProductsController extends Mage_Core_Controller_Front_Action
{
    /**
     * Display products with a specific attribute
     *
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
