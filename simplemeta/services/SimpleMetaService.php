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

		/* Assets */
		$assetFields = array(
			'socialOGImageId',
			'socialOGAudioContentId',
			'socialOGVideoContentId',
			'socialTwitterGalleryImagesId',
			'socialTwitterPhotoId',
			'socialTwitterProductImageId',
			'socialTwitterSummaryImageId',
			'socialTwitterSummaryLargeImageId',
		);

		foreach ($assetFields as $field) {
			$attr[$field] = (!empty($attr[$field]) ? $attr[$field][0] : null);
		}

		/* DateTime */
		$dateFields = array(
			'socialOGMusicAlbumReleaseDate',
			'socialOGVideoMovieReleaseDate',
			'socialOGVideoEpisodeReleaseDate',
			'socialOGVideoTVShowReleaseDate',
			'socialOGVideoOtherReleaseDate',
		);

		foreach ($dateFields as $field) {
			$attr[$field] = (($date = $attr[$field]) ? DateTime::createFromString($date, craft()->timezone) : null);
		}

		/* Set Attributes */
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
