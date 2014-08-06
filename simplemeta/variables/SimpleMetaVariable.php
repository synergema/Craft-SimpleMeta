<?php
namespace Craft;

class SimpleMetaVariable
{

	// Get Asset by Id
	public function asset($id)
	{
		return craft()->simpleMeta->getAssetById($id);
	}

}