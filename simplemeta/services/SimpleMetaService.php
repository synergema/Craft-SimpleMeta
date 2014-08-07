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

		if (!$attr)
		{
			return false;
		}

		$simpleMetaRecord = SimpleMeta_SimpleMetaRecord::model()->findByAttributes(array(
			'elementId' => $elementId,
			'handle'    => $handle,
			));

		if (!$simpleMetaRecord)
		{
			$simpleMetaRecord = new SimpleMeta_SimpleMetaRecord;
			$attr['elementId'] = $elementId;
			$attr['handle']    = $handle;
		}

		$attr['socialOGImageId']                  = (!empty($attr['socialOGImageId']) ? $attr['socialOGImageId'][0] : null);
		$attr['socialOGAudioContentId']           = (!empty($attr['socialOGAudioContentId']) ? $attr['socialOGAudioContentId'][0] : null);
		$attr['socialOGVideoContentId']           = (!empty($attr['socialOGVideoContentId']) ? $attr['socialOGVideoContentId'][0] : null);
		$attr['socialTwitterGalleryImagesId']     = (!empty($attr['socialTwitterGalleryImagesId']) ? $attr['socialTwitterGalleryImagesId'][0] : null);
		$attr['socialTwitterPhotoId']             = (!empty($attr['socialTwitterPhotoId']) ? $attr['socialTwitterPhotoId'][0] : null);
		$attr['socialTwitterProductImageId']      = (!empty($attr['socialTwitterProductImageId']) ? $attr['socialTwitterProductImageId'][0] : null);
		$attr['socialTwitterSummaryImageId']      = (!empty($attr['socialTwitterSummaryImageId']) ? $attr['socialTwitterSummaryImageId'][0] : null);
		$attr['socialTwitterSummaryLargeImageId'] = (!empty($attr['socialTwitterSummaryLargeImageId']) ? $attr['socialTwitterSummaryLargeImageId'][0] : null);

		$simpleMetaRecord->setAttributes($attr, false);

		return $simpleMetaRecord->save();

	}

	/**
	 * Returns data from field
	 *
	 * @param BaseFieldType
	 * @return SimpleMeta_SimpleMetaModel
	 */
	public function getSimpleMeta(BaseFieldType $fieldType)
	{
		$simpleMetaRecord = SimpleMeta_SimpleMetaRecord::model()->findByAttributes(array(
			'elementId' => $fieldType->element->id,
			'handle'    => $fieldType->model->handle,
		));

		if ($simpleMetaRecord)
		{
			$attr = $simpleMetaRecord->getAttributes();
		} else
		{
			$attr = array();
		}

		return $attr;
	}

	/**
	 * Returns data by entry id for use on the front-end
	 *
	 * @param int $id
	 * @return SimpleMeta_SimpleMetaModel
	 */
	public function outputSimpleMeta($entry, $fallback)
	{

		$id = ($entry) ? $entry->id : (($fallback) ? $fallback->id : false);

		if ($id)
		{
			$simpleMetaRecord = SimpleMeta_SimpleMetaRecord::model()->findByAttributes(array(
				'elementId' => $id,
			));

			if ($simpleMetaRecord)
			{
				$attr = $simpleMetaRecord->getAttributes();
			}

			$templatesPath = craft()->path->getPluginsPath().'simplemeta/templates/';
			craft()->path->setTemplatesPath($templatesPath);

			return craft()->templates->render('output', $attr);

		} else {
			return false;
		}
	}


	/**
	 * Returns an asset by id.
	 *
	 * @param int $id
	 * @return AssetFileModel|null
	 */
	public function getAssetById($id)
	{
		return craft()->elements->getElementById($id, ElementType::Asset);
	}

}
