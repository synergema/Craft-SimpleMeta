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
			// 'socialOGAudioContentId',
			// 'socialOGVideoContentId',
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
//			'socialOGMusicAlbumReleaseDate',
//			'socialOGVideoMovieReleaseDate',
//			'socialOGVideoEpisodeReleaseDate',
//			'socialOGVideoTVShowReleaseDate',
//			'socialOGVideoOtherReleaseDate',
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
			} else {
				$attr = SimpleMeta_SimpleMetaRecord::model()->getAttributes();
			}

			// Capture the original templates path
			$oldPath = craft()->path->getTemplatesPath();
			// Set the new path for rendering the plugin template
			$newPath = craft()->path->getPluginsPath() . 'simplemeta/templates/';

			// Set system to new templates path
			craft()->path->setTemplatesPath($newPath);

			// Render the HTMl from the plugin's template
			$html    = craft()->templates->render('output', $attr);

			// Set the system templates back or else front-end will bomb out
			craft()->path->setTemplatesPath($oldPath);

			return $html;

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

	/**
	 * Given a string containing any combination of YouTube and Vimeo video URLs in
	 * a variety of formats (iframe, shortened, etc), each separated by a line break,
	 * parse the video string and determine it's valid embeddable URL for usage in
	 * popular JavaScript lightbox plugins.
	 *
	 * In addition, this handler grabs both the maximize size and thumbnail versions
	 * of video images for your general consumption. In the case of Vimeo, you must
	 * have the ability to make remote calls using file_get_contents(), which may be
	 * a problem on shared hosts.
	 *
	 * Data gets returned in the format:
	 *
	 * array(
	 *   array(
	 *     'url' => 'http://path.to/embeddable/video',
	 *     'thumbnail' => 'http://path.to/thumbnail/image.jpg',
	 *     'fullsize' => 'http://path.to/fullsize/image.jpg',
	 *   )
	 * )
	 *
	 * @param       string  $videoString
	 * @return      array   An array of video metadata if found
	 *
	 * @author      Corey Ballou http://coreyballou.com
	 * @copyright   (c) 2012 Skookum Digital Works http://skookum.com
	 * @license     
	 */
	function parseVideos($videoString = null)
	{
	    // return data
	    $videos = array();

	    if (!empty($videoString)) {

	        // split on line breaks
	        $videoString = stripslashes(trim($videoString));
	        $videoString = explode("\n", $videoString);
	        $videoString = array_filter($videoString, 'trim');

	        // check each video for proper formatting
	        foreach ($videoString as $video) {

	            // check for iframe to get the video url
	            if (strpos($video, 'iframe') !== FALSE) {
	                // retrieve the video url
	                $anchorRegex = '/src="(.*)?"/isU';
	                $results = array();
	                if (preg_match($anchorRegex, $video, $results)) {
	                    $link = trim($results[1]);
	                }
	            } else {
	                // we already have a url
	                $link = $video;
	            }

	            // if we have a URL, parse it down
	            if (!empty($link)) {

	                // initial values
	                $video_id = NULL;
	                $videoIdRegex = NULL;
	                $results = array();

	                // check for type of youtube link
	                if (strpos($link, 'youtu') !== FALSE) {
	                    // works on:
	                    // http://www.youtube.com/watch?v=VIDEOID
						if(strpos($link, 'youtube.com/watch') !== FALSE){
							$videoIdRegex = '/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/';
						}
						else if (strpos($link, 'youtube.com') !== FALSE) {
	                        // works on:
	                        // http://www.youtube.com/embed/VIDEOID
	                        // http://www.youtube.com/embed/VIDEOID?modestbranding=1&amp;rel=0
	                        // http://www.youtube.com/v/VIDEO-ID?fs=1&amp;hl=en_US
	                        $videoIdRegex = '/youtube.com\/(?:embed|v){1}\/([a-zA-Z0-9_]+)\??/i';
	                    } else if (strpos($link, 'youtu.be') !== FALSE) {
	                        // works on:
	                        // http://youtu.be/daro6K6mym8
	                        $videoIdRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
	                    }

	                    if ($videoIdRegex !== NULL) {
	                        if (preg_match($videoIdRegex, $link, $results)) {
	                            $video_str = 'http://www.youtube.com/v/%s?fs=1&amp;autoplay=1';
	                            $thumbnail_str = 'http://img.youtube.com/vi/%s/2.jpg';
	                            $fullsize_str = 'http://img.youtube.com/vi/%s/0.jpg';
	                            $video_id = $results[1];
	                        }
	                    }
	                }

	                // handle vimeo videos
	                else if (strpos($video, 'vimeo') !== FALSE) {
	                    if (strpos($video, 'player.vimeo.com') !== FALSE) {
	                        // works on:
	                        // http://player.vimeo.com/video/37985580?title=0&amp;byline=0&amp;portrait=0
	                        $videoIdRegex = '/player.vimeo.com\/video\/([0-9]+)\??/i';
	                    } else {
	                        // works on:
	                        // http://vimeo.com/37985580
	                        $videoIdRegex = '/vimeo.com\/([0-9]+)\??/i';
	                    }

	                    if ($videoIdRegex !== NULL) {
	                        if (preg_match($videoIdRegex, $link, $results)) {
	                            $video_id = $results[1];

	                            // get the thumbnail
	                            try {
	                                $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
	                                if (!empty($hash) && is_array($hash)) {
	                                    $video_str = 'http://vimeo.com/moogaloop.swf?clip_id=%s';
	                                    $thumbnail_str = $hash[0]['thumbnail_small'];
	                                    $fullsize_str = $hash[0]['thumbnail_large'];
	                                } else {
	                                    // don't use, couldn't find what we need
	                                    unset($video_id);
	                                }
	                            } catch (Exception $e) {
	                                unset($video_id);
	                            }
	                        }
	                    }
	                }

	                // check if we have a video id, if so, add the video metadata
	                if (!empty($video_id)) {
	                    // add to return
	                    $videos[] = array(
	                        'url' => sprintf($video_str, $video_id),
	                        'thumbnail' => sprintf($thumbnail_str, $video_id),
	                        'fullsize' => sprintf($fullsize_str, $video_id)
	                    );
	                }
	            }

	        }

	    }

	    // return array of parsed videos
	    return $videos;
	}

}
