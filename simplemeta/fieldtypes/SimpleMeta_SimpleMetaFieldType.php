<?php

/**
 * Simple Meta by Synergema
 *
 * @package   Simple Meta
 * @author    Synergema
 * @copyright Copyright (c) 2014, Synergema
 * @link      http://synergema.com
 * @license   GNU Public License (http://opensource.org/licenses/gpl-license.php)
 */

namespace Craft;

class SimpleMeta_SimpleMetaFieldType extends BaseFieldType
{

	public function getName()
	{
		return Craft::t('Simple Meta');
	}

	public function defineContentAttribute()
	{
		return false;
	}

	public function modifyElementsQuery(DbCommand $query, $params)
	{
		if ($params !== null) {
			craft()->simpleMeta->modifyQuery($query, $params);
		}
	}

	public function getInputHtml($name, $value)
	{

		// Include JavaScript & CSS
		craft()->templates->includeJsResource('simplemeta/simple.meta.js');
		craft()->templates->includeCssResource('simplemeta/simple.meta.css');


		// Whether any assets sources exist
		$sources = craft()->assets->findFolders();
		$variables['assetsSourceExists'] = count($sources);

		// URL to create a new assets source
		$variables['newAssetsSourceUrl'] = UrlHelper::getUrl('settings/assets/sources/new');

		if (!empty($value)) {
			$simpleMetaModel = SimpleMeta_SimpleMetaModel::populateModel($value);
		} else {
			$simpleMetaModel = new SimpleMeta_SimpleMetaModel;
			$simpleMetaModel->handle = $name;
		}

		// Set assets
		$simplemetaAssets = array(
			'socialOGImage'                  => $simpleMetaModel->socialOGImageId,
			// 'socialOGAudioContent'           => $simpleMetaModel->socialOGAudioContentId,
			// 'socialOGVideoContent'           => $simpleMetaModel->socialOGVideoContentId,
			'socialTwitterGalleryImages'     => $simpleMetaModel->socialTwitterGalleryImagesId,
			'socialTwitterPhoto'             => $simpleMetaModel->socialTwitterPhotoId,
			'socialTwitterProductImage'      => $simpleMetaModel->socialTwitterProductImageId,
			'socialTwitterSummaryImage'      => $simpleMetaModel->socialTwitterSummaryImageId,
			'socialTwitterSummaryLargeImage' => $simpleMetaModel->socialTwitterSummaryLargeImageId,
		);

		foreach ($simplemetaAssets as $key => $value) {
			if ($value) {
				$asset = craft()->elements->getElementById($value);
				$variables[$key . 'Elements'] = array($asset);
				$variables[$key . 'Id'] = $asset->id;
			} else {
				$variables[$key . 'Elements'] = array();
				$variables[$key . 'Id'] = "";
			}
		}

		// Set element type
		$variables['elementType'] = craft()->elements->getElementType(ElementType::Asset);

		$data = array_merge($simpleMetaModel->getAttributes(), $variables);

		return craft()->templates->render('simplemeta/input', $data);
	}

	public function prepValue($value)
	{
		return craft()->simpleMeta->getSimpleMeta($this);
	}

	public function onAfterElementSave()
	{
		return craft()->simpleMeta->saveSimpleMeta($this);
	}
}
