<?php
/**
* One Pica
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to codemaster@onepica.com so we can send you a copy immediately.
*
* @category OnePica
* @package OnePica_ArqSpin
* @copyright Copyright (c) 2012 One Pica, Inc. (http://www.onepica.com)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*/
/**
* One Pica ArqSpin
*
* @category OnePica
* @package OnePica_ArqSpin
* @author One Pica Codemaster codemaster@onepica.com
*/
class OnePica_ArqSpin_Block_Adminhtml_Tabs extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs
{
    private $parent;
 
    protected function _prepareLayout()
    {
        //get all existing tabs
        $this->parent = parent::_prepareLayout();
        //add new tab
        $this->addTab('arqball_spins', array(
                     'label'     => Mage::helper('catalog')->__('ArqSpins'),
                     'content'   => $this->getLayout()
									->createBlock('arqspin/adminhtml_tabs_productEdit')->toHtml(),
        ));
        return $this->parent;
    }
}