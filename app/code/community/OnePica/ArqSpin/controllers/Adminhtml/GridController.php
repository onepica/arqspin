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
* @copyright Copyright (c) 2013 One Pica, Inc. (http://www.onepica.com)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*/
/**
* One Pica ArqSpin
*
* @category OnePica
* @package OnePica_ArqSpin
* @author One Pica Codemaster codemaster@onepica.com
*/
class OnePica_ArqSpin_Adminhtml_GridController extends Mage_Adminhtml_Controller_Action
{

    protected function _construct() {
        $this->setUsedModuleName('OnePica_ArqSpin');
    }
	
	public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
	
	public function listAction() {
		$url			= 'https://api.arqspin.com/v2.0/spins/';
		$searchString	= $this->getRequest()->getParam('searchString');
		$config 		= Mage::getStoreConfig('arqspin/arqspin_general');
		$product		= Mage::getModel('catalog/product')->load($this->getRequest()->getParam('id'));
		$preId			= $product->getArqballspinId();
		$res			= '';

		if (isset($config)) {
			$data = file_get_contents($url.$config['username'].(strlen($searchString) ? '?query='.$searchString : ''));
			$data = json_decode($data, true);
			if (isset($data['spins'])) {
				foreach ($data['spins'] as $value) {
					$res .= '<tr>';
					$res .= '<td><input type="radio" name="product[arqspin_id]" value="'.$value['shortid'].'"'.($value['shortid'] == $preId ? ' checked' : '').'></td>';
					$res .= '<td>'.(strlen($value['shortid']) ? $value['shortid'] : '&nbsp;').'</td>';
					$res .= '<td>'.(strlen($value['title']) ? Mage::helper('core/string')->truncate($value['title'], 100) : '&nbsp;').'</td>';
					$res .= '<td><img src="'.$value['thumbnail'].'" width="100" class="arqball_spin_preview" shortid="'.$value['shortid'].'" /></td>';
					$res .= '</tr>';
				}
			}
		}
		echo $this->getHeader().$res.$this->getFooter();
		exit;
	}
	
	public function getHeader() {
		$res = '<table id="media_gallery_content_grid" class="data border" width="100%" cellspacing="0">';
		$res .= '<thead>';
		$res .= '<tr class="headings">';
		$res .= '<th width="20">&nbsp;</th>';
		$res .= '<th width="100">ID</th>';
		$res .= '<th>Title</th>';
		$res .= '<th width="100">Thumbnail</th>';
		$res .= '</tr>';
		$res .= '</thead>';

		$res .= '<tbody id="media_gallery_content_list">';
		$res .= '<tr>';
		$res .= '<td width="20"><input type="radio" name="product[arqspin_id]" value="" checked></td>';
		$res .= '<td width="100">&nbsp;</td>';
		$res .= '<td>None</td>';
		$res .= '<td width="100">&nbsp;</td>';
		$res .= '</tr>';
		$res .= '</tbody>';
		return $res;
	}
	
	public function getFooter() {
		return '</table>';
	}
}