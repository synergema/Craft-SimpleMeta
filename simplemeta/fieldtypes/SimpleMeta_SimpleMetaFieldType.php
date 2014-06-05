<?php

/**
 * Ace Freely by Brandon Haslip
 *
 * @package   Ace Freely (Named by Chad J. Clark)
 * @author    Brandon Haslip
 * @copyright Copyright (c) 2014, Brandon Haslip
 * @link      http://brandonhaslip.com
 * @license   GNU Public License (http://opensource.org/licenses/gpl-license.php)
 */

namespace Craft;

class SimpleMeta_SimpleMetaFieldType extends BaseFieldType
{
	/**
	 * Get the name of this fieldtype
	 */
	public function getName()
	{
		return Craft::t('Simple Meta');
	}

	/**
	 * Get this fieldtype's column type.
	 *
	 * @return string
	 */
	public function defineContentAttribute()
	{
		return array(AttributeType::String, 'column' => ColumnType::Text);
	}

	/**
	 * Get this fieldtype's form HTML
	 *
	 * @param  string $name
	 * @param  mixed  $value
	 * @return string
	 */
	public function getInputHtml($name, $value)
	{

		// Include JavaScript & CSS
		craft()->templates->includeJsResource('simplemeta/simple.meta.js');
		craft()->templates->includeCssResource('simplemeta/simple.meta.css');

		return craft()->templates->render('SimpleMeta/input', array('value' => $value));
	}
}
