<?php
namespace Craft;

class SimpleMetaVariable
{

	// Output
	public function output($entry = false, $fallback = false)
	{
		return craft()->simpleMeta->outputSimpleMeta($entry, $fallback);
	}

	// Get Asset by Id
	public function asset($id)
	{
		return craft()->simpleMeta->getAssetById($id);
	}

}