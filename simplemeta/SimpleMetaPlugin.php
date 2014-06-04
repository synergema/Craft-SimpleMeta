<?php

/**
 * Ace Freely by Brandon Haslip
 *
 * @package   Simple Meta
 * @author    Synergema
 * @copyright Copyright (c) 2014, Synergema
 * @link      http://synergema.com
 * @license   GNU Public License (http://opensource.org/licenses/gpl-license.php)
 */

namespace Craft;

class SimpleMetaPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Simple Meta');
	}

	public function getVersion()
	{
		return '1.0';
	}

	public function getDeveloper()
	{
		return 'Synergema';
	}

	public function getDeveloperUrl()
	{
		return 'http://synergema.com';
	}
}