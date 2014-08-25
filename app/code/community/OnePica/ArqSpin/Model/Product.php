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
class OnePica_ArqSpin_Model_Product extends Mage_Catalog_Model_Product
{
    /**
     * Retrive media gallery images
     *
     * @return Varien_Data_Collection
     */
    public function getMediaGalleryImages()
    {
        if(!$this->hasData('media_gallery_images') && is_array($this->getMediaGallery('images'))) {
			$arqspin=$this->getArqspinImage();
            $images = new Varien_Data_Collection();
			if ($arqspin && $arqspin['position'] == 'first') {
				$images->addItem(new Varien_Object($arqspin));
			}
            foreach ($this->getMediaGallery('images') as $image) {
                if ($image['disabled']) {
                    continue;
                }
                $image['url'] = $this->getMediaConfig()->getMediaUrl($image['file']);
                $image['id'] = (isset($image['value_id']) ? $image['value_id'] : null);
                $image['path'] = $this->getMediaConfig()->getMediaPath($image['file']);
				$image['is_arqspin'] = false;
                $images->addItem(new Varien_Object($image));
            }
			if ($arqspin && $arqspin['position'] == 'last') {
				$images->addItem(new Varien_Object($arqspin));
			}
            $this->setData('media_gallery_images', $images);
        }

        return $this->getData('media_gallery_images');
    }
	
	public function getArqspin()
	{
		$id		= $this->getData('arqspin_id');;
		$config	= Mage::getStoreConfig('arqspin/arqspin_general');
		if (!$id || !isset($config)) return false;
		$image	= array(
			'id'				=> $id,
			'url'				=> $config['thumbnail_url'].'/'.$id.'/thumbnail.jpg',
			'spin_url'			=> 	'http://arq.io/'.($config['embed_type'] == 'flash' ? 'f' : 'i').'/?spin='.$id.($config['autoload'] ? '&is=-0.16' : '').($config['autostop'] ? '' : '&ms=0.16&L=1'),
			'width'				=> 0,
			'height'			=> 0,
		);
		$info = getimagesize($image['url']);
		if (count($info)) {
			$image['width'] = $info[0];
			$image['height'] = $info[1];
		}
		return array(
			'config'	=> $config,
			'image'		=> $image
		);
	}
	
	public function getArqspinImage()
	{
		$arqspin = $this->getArqspin();
		if (!$arqspin || $arqspin['config']['display_type'] != 'gallery') return false;
		return array(
			'value_id'			=> $arqspin['image']['id'],
			'file'				=> $arqspin['image']['url'],
			'label'				=> '',
			'position'			=> $arqspin['config']['gallery_position'],
			'disabled'			=> 0,
			'label_default'		=> '',
			'position_default'	=> $arqspin['config']['gallery_position'],
			'disabled_default'	=> 0,
			'url'				=> $arqspin['image']['url'],
			'id'				=> $arqspin['image']['id'],
			'path'				=> $arqspin['image']['url'],
			'spin_url'			=> $arqspin['image']['spin_url'],
			'is_arqspin'		=> true,
		);
	}
}
