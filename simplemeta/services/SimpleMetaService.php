<?php
namespace Craft;

class SimpleMetaService extends BaseApplicationComponent
{

	public function modifyQuery(DbCommand $query, $params = array())
	{
		$query->join(SimpleMeta_SimpleMetaRecord::TABLE_NAME, 'elements.id='.craft()->db->tablePrefix.SimpleMeta_SimpleMetaRecord::TABLE_NAME.'.elementId');
	}

	public function saveSimpleMeta(BaseFieldType $fieldType)
	{
		$handle    = $fieldType->model->handle;
		$elementId = $fieldType->element->id;
		$content   = $fieldType->element->getContent();

		$attr = $content->getAttribute($handle);

		if (!$attr) {
			return false;
		}

		$simpleMetaRecord = SimpleMeta_SimpleMetaRecord::model()->findByAttributes(array(
			'elementId' => $elementId,
			'handle'    => $handle,
			));

		if (!$simpleMetaRecord) {
			$simpleMetaRecord = new SimpleMeta_SimpleMetaRecord;
			$attr['elementId'] = $elementId;
			$attr['handle']    = $handle;
		}

		if (!$attr['socialOGTitle'])            {$attr['socialOGTitle']            = null;}
		if (!$attr['socialOGDescription'])      {$attr['socialOGDescription']      = null;}
		if (!$attr['socialTwitterTitle'])       {$attr['socialTwitterTitle']       = null;}
		if (!$attr['socialTwitterDescription']) {$attr['socialTwitterDescription'] = null;}
		if (!$attr['seoTitle'])                 {$attr['seoTitle']                 = null;}
		if (!$attr['seoDescription'])           {$attr['seoDescription']           = null;}
		if (!$attr['seoCanonicalUrl'])          {$attr['seoCanonicalUrl']          = null;}

		$simpleMetaRecord->setAttributes($attr, false);

		return $simpleMetaRecord->save();

	}

	public function getSimpleMeta(BaseFieldType $fieldType)
	{
		$simpleMetaRecord = SimpleMeta_SimpleMetaRecord::model()->findByAttributes(array(
			'elementId' => $fieldType->element->id,
			'handle'    => $fieldType->model->handle,
		));

		if ($simpleMetaRecord) {
			$attr = $simpleMetaRecord->getAttributes();
		} else {
			$attr = array();
		}

		return $attr;
	}
}
