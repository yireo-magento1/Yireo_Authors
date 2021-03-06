<?php
/**
 * Yireo Authors
 *
 * @package     Yireo_Authors
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
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
