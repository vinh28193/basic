<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\base\Exception;
use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;
/**
 * ImageManager represents the model behind the search form of `app\models\resources\Image`.
 */
class ImageManager extends \app\models\resources\Image
{

	const INPUT_PARAM = 'ImageManagerInput';

  	const IMAGE_OUTBOUND = ManipulatorInterface::THUMBNAIL_OUTBOUND;
	const IMAGE_INSET = ManipulatorInterface::THUMBNAIL_INSET;

	/** @var string $cachePath path alias relative with webroot where the cache files are kept */
	public $cachePath = 'assets/images';

	/** @var int $cacheExpire */
	public $cacheExpire = 0;

	/** @var int $imageQuality */
	public $imageQuality = 50;

	/** @var int $useFilename if true show filename in url */
	public $useFilename = false;

	/** @var int $absoluteUrl if true include domain in url */
	public $absoluteUrl = false;

	public $imageOptions = ['width' => 0, 'height' => 0, 'size' => 0];

	/**
	 * Creates and caches the image thumbnail and returns full path from thumbnail file.
	 *
	 * @param string $filePath to original file
	 * @param integer $width
	 * @param integer $height
	 * @param string $mode
	 * @param integer $quality (1 - 100 quality)
	 * @param string $chosenFileName (custome filename)
	 * @return string
	 * @throws Exception
	 */
	public function generate($filePath, $width, $height, $mode = self::IMAGE_OUTBOUND, $quality = null, $chosenFileName = null) {
		
		$filePath = FileHelper::normalizePath(Yii::getAlias($filePath));
		if (!is_file($filePath)) {
			throw new Exception("File $filePath doesn't exist");
		}

		//set resize mode
		$resizeMode = null;
		switch ($mode) {
			case self::IMAGE_OUTBOUND:
				$resizeMode = self::IMAGE_OUTBOUND;
				break;
			case self::IMAGE_INSET:
				$resizeMode = self::IMAGE_INSET;
				break;
			default:
				throw new Exception('generateImage $mode is not valid choose for "outbound" or "inset"');
		}

		//create some vars
		$cachePath = Yii::getAlias('@webroot/' . $this->cachePath);
		//get fileinfo
		$fileInfo = pathinfo($filePath);
		//set default filename
		$fileHash = md5($filePath . $width . $height . $resizeMode . filemtime($filePath));
		$imageFileName = null;
		//if $this->useFilename set to true? use seo friendly name
		if ($this->useFilename === true) {
			//set hash and default name
			$fileHashShort = substr($fileHash, 0, 6);
			$fileName = $fileInfo['filename'];
			//set choosen filename if $chosenFileName not null.
			if ($chosenFileName !== null) {
				$fileName = preg_replace('/(\.\w+)$/', '', $chosenFileName);
			}
			//replace for seo friendly file name
			$sFilenameReplace = preg_replace("/[^\w\.\-]+/", '-', $fileName);
			//set filename
			$imageFileName = $sFileHashShort . "_" . $sFilenameReplace;
			//else use file hash as filename	
		} else {
			$imageFileName = $fileHash;
		}

		$imageFileExt = "." . $fileInfo['extension'];
		$imageFilePath = $cachePath . DIRECTORY_SEPARATOR . substr($imageFileName, 0, 2);
		$imageFile = $imageFilePath . DIRECTORY_SEPARATOR . $imageFileName . $imageFileExt;

		if (file_exists($imageFile)) {
			if ($this->cacheExpire !== 0 && (time() - filemtime($imageFile)) > $this->cacheExpire) {
				unlink($imageFile);
			} else {
				return $imageFile;
			}
		}
		//if dir not exist create cache edir
		if (!is_dir($imageFilePath)) {
			FileHelper::createDirectory($imageFilePath, 0755);
		}
		//create image
		$box = new Box($width, $height);
		$image = Image::getImagine()->open($filePath);
		$image = $image->thumbnail($box, $resizeMode);

		$options = [
			'quality' => $quality === null ? $this->imageQuality : $quality
		];
		$image->save($imageFile, $options);
		return $imageFile;
	}

	/**
	 * Creates and caches the image and returns URL from resized file.
	 *
	 * @param string $filePath to original file
	 * @param integer $width
	 * @param integer $height
	 * @param string $mode
	 * @param integer $quality (1 - 100 quality)
	 * @param string $fileName (custome filename)
	 * @return string
	 */
	public function getUrl($filePath, $width, $height, $mode = "outbound", $quality = null, $fileName = null) {
		//get original file 
		$normalizePath = FileHelper::normalizePath(Yii::getAlias($filePath));
		//get cache url
		$cacheUrl = Yii::getAlias($this->cachePath);
		//generate file
		$resizedFilePath = self::generate($normalizePath, $width, $height, $mode, $quality, $fileName);
		//get resized file
		$normalizeResizedFilePath = FileHelper::normalizePath($resizedFilePath);
		$resizedFileName = pathinfo($normalizeResizedFilePath, PATHINFO_BASENAME);
		//get url
		$sFileUrl = Url::to('@web/' . $cacheUrl . '/' . substr($resizedFileName, 0, 2) . '/' . $resizedFileName, $this->absoluteUrl);
		//return path
		return $sFileUrl;
	}

	/**
	 * Clear cache directory.
	 *
	 * @return bool
	 */
	public function clearCache() {
		$cachePath = Yii::getAlias('@webroot/' . $this->cachePath);
		//remove dir
		FileHelper::removeDirectory($cachePath);
		//creat dir
		return FileHelper::createDirectory($cachePath, 0755);
	}

	/**
	 * Get the path for the given ImageManage record
	 * @param int $id ImageManage record for which the path needs to be generated
	 * @param int $width Thumbnail image width
	 * @param int $height Thumbnail image height
	 * @param string $thumbnailMode Thumbnail mode
	 * @return null|string Full path is returned when image is found, null if no image could be found
	 */
	public function getImageSrc($id, $width = 400, $height = 400, $thumbnailMode = "outbound") {
		//default return
		$return = null;
		$mImageManage = self::findOne($id);

		//check if not empty
		if ($mImageManage !== null) {
			//set crop mode
			$mode = $thumbnailMode == "outbound" ? "outbound" : "inset";

			$imageFilePath = $this->fullPath;
			//check file exists
			if (file_exists($imageFilePath)) {
				$return = $this->getUrl($imageFilePath, $width, $height, $mode);
			} else {
				$return = null; //"/img/img_no-image.png";
			}
		}
		return $return;
	}

	/**
	 * Get image path private
	 * @return string|null If image file exists the path to the image, if file does not exists null
	 */
	public function getImagePathPrivate() {
		//get image file path
		$imageFilePath = $this->fullPath;
		//check file exists
		if (file_exists($imageFilePath)) {
			return $imageFilePath;
		}
		return null;
	}

	/**
	 * Get image data dimension/size
	 * @return array The image sizes
	 */
	public function getImageDetails() {
		//set default return
		$options = $this->imageOptions;
		//get image file path
		$imagePath = $this->fullPath;
		//check file exists
		if (file_exists($imagePath)) {
			$imageDimension = getimagesize($imagePath);
			$options['width'] = isset($imageDimension[0]) ? $imageDimension[0] : 0;
			$options['height'] = isset($imageDimension[1]) ? $imageDimension[1] : 0;
			$options['size'] = Yii::$app->formatter->asShortSize(filesize($imagePath), 2);
		}
		return $options;
	}

}
