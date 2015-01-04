<?php
/**
 * Yireo Authors
 *
 * @author      Yireo (http://www.yireo.com/)
 * @package     Yireo_Authors
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 * @link        http://www.yireo.com/
 */

class Yireo_Authors_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function parseValue($value, $include_label)
    {
        if(preg_match('/^([0-9\,\ ]+)$/', $value)) {
            $authors = Mage::helper('authors')->getAuthors($value);
            if(!empty($authors)) {
                $value = Mage::helper('authors')->authorsToString($authors);
            } else {
                $value = Mage::helper('authors')->__('Unknown');
            }
        }

        if($include_label) {
            if(!empty($authors) && count($authors) > 1) {
                return '<span class="name">'.Mage::helper('authors')->__('Authors').'</span>: '.$value;
            } else {
                return '<span class="name">'.Mage::helper('authors')->__('Author').'</span>: '.$value;
            }
        }

        return $value;
    }

    public function getAuthors($value)
    {
        $value = preg_replace('/^,/', '', $value);
        $value = preg_replace('/,$/', '', $value);

        $resource = Mage::getSingleton('core/resource')->getConnection('core_read');
        $table = Mage::getSingleton('core/resource')->getTableName('authors/author');
        $query = 'SELECT * FROM '.$table.' WHERE `author_id` IN ('.$value.')';

        return $resource->fetchAll($query);
    }

    public function authorsToString($authors, $html = true)
    {
        $value = '';
        if(!empty($authors)) {
            $values = array();
            foreach($authors as $author) {

                if(empty($author['full_name'])) {
                    continue;
                }

                $author_value = $author['full_name'];
                if($html == true) {
                    $author_url = Mage::getUrl('authors/products/index', array('id' => $author['author_id']));
                    $author_value = '<a href="'.$author_url.'">'.$author_value.'</a>';
                }

                $values[] = $author_value;
            }
            $value = implode(', ', $values);
        }
        return $value;
    }
}
