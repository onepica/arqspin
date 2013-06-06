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
class OnePica_ArqSpin_Block_Product_View_Media extends Mage_Catalog_Block_Product_View_Media
{
	
	public function getThumbnail($image = null)
	{
		if ($image) {
			if ($image->getIsArqspin()) {
				return $image->getUrl();
			} else return $this->helper('catalog/image')->init($this->getProduct(), 'thumbnail', $image->getFile())->resize(48);
		}
	}
}
