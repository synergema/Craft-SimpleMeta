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

		if (!empty($value)) {
			$simpleMetaModel = SimpleMeta_SimpleMetaModel::populateModel($value);
		} else {
			$simpleMetaModel = new SimpleMeta_SimpleMetaModel;
			$simpleMetaModel->handle = $name;
		}

		return craft()->templates->render('simplemeta/input', $simpleMetaModel->getAttributes());
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
