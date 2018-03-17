<?php
namespace app\modules\mediamanage\models;

use stdClass;
use Yii;
use yii\base\Object;
use yii\helpers\FileHelper;

class Media extends Object
{

	const MAX_ROWS_RENDER = 50;

	public $medias = [];

	private $_defaultPath = [
		'/uploads/temp/Koala.jpg',
		'/uploads/temp/Chrysanthemum.jpg',
		'/uploads/temp/Desert.jpg',
		'/uploads/temp/Hydrangeas.jpg',
		'/uploads/temp/Jellyfish.jpg',
		'/uploads/temp/Lighthouse.jpg',
		'/uploads/temp/Penguins.jpg',
		'/uploads/temp/Tulips.jpg',
	];
	public function init()
	{
		parent::init();

		for ($index = 1; $index  <= self::MAX_ROWS_RENDER; $index ++) { 
			$rand = rand(0 , count($this->_defaultPath) - 1);
			$mediaSrc = $this->_defaultPath[$rand];
			$mediaName = explode('/',$mediaSrc)[3];
			$mediaName = explode('.jpg',$mediaName)[0];
			$media = new stdClass;
			$media->id = $index;
			$media->name = $mediaName;
			$media->src = $mediaSrc;
			$this->medias[] = $media;
		}
	}
	public function findAll($params){
	
		if(isset($params['name']) && $params['name'] !== ''){
			$medias = [];
			foreach ($this->medias as $key => $media) {
				if (strpos($media->name, $params['name']) !== false) {
	                $medias[] = $media;
	            }
			}
			$this->medias = $medias;
		}
		return $this->medias;
	}
}
?>