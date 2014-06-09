<?php
namespace Craft;

class SimpleMeta_SimpleMetaRecord extends BaseRecord
{
	const TABLE_NAME = 'simplemeta';

	public function getTableName()
	{
		return static::TABLE_NAME;
	}

	protected function defineAttributes()
	{

		// Open Graph Types
		$openGraphTypes = array(
			'article',
			'book',
			'music.song',
			'music.album',
			'music.playlist',
			'music.radio_station',
			'profile',
			'video.movie',
			'video.episode',
			'video.tv_show',
			'website',
		);

		// Twitter Card Types
		$twitterCardTypes = array(
			'summary',
			'summary_large_image',
			'photo',
			'product',
			'app',
			'player',
		);

		// Robots Index
		$robotsIndex = array(
			'index',
			'noindex',
		);

		// Robots Follow
		$robotsFollow = array(
			'follow',
			'nofollow',
		);

		return array(
			'elementId'                  => AttributeType::Number,
			'handle'                     => AttributeType::String,
			'smSocialOGTitle'            => AttributeType::String,
			'smSocialOGDescription'      => AttributeType::String,
			'smSocialOGType'             => array(AttributeType::Enum, 'values' => $openGraphTypes,   'default' => $openGraphTypes[0]),
			'smSocialTwitterTitle'       => AttributeType::String,
			'smSocialTwitterType'        => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
			'smSocialTwitterDescription' => AttributeType::String,
			'smSEOTitle'                 => AttributeType::String,
			'smSEODescription'           => AttributeType::String,
			'smSEOCanonicalUrl'          => AttributeType::String,
			'smSEORobotsIndex'           => array(AttributeType::Enum, 'values' => $robotsIndex,      'default' => $robotsIndex[0]),
			'smSEORobotsFollow'          => array(AttributeType::Enum, 'values' => $robotsFollow,     'default' => $robotsFollow[0]),
		);

	}

	public function defineRelations()
	{
		return array(
			'element' => array(static::BELONGS_TO, 'ElementRecord', 'required' => true, 'onDelete' => static::CASCADE),
		);
	}
}
