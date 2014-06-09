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

		// Sitemap Priority
		$sitemapPriority = array(
			'',
			'1',
			'0.9',
			'0.8',
			'0.7',
			'0.6',
			'0.5',
			'0.4',
			'0.3',
			'0.2',
			'0.1',
		);

		return array(
			'elementId'                => AttributeType::Number,
			'handle'                   => AttributeType::String,
			'socialOGTitle'            => AttributeType::String,
			'socialOGDescription'      => AttributeType::String,
			'socialOGType'             => array(AttributeType::Enum, 'values' => $openGraphTypes,   'default' => $openGraphTypes[0]),
			'socialTwitterTitle'       => AttributeType::String,
			'socialTwitterType'        => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
			'socialTwitterDescription' => AttributeType::String,
			'seoTitle'                 => AttributeType::String,
			'seoDescription'           => AttributeType::String,
			'seoCanonicalUrl'          => AttributeType::String,
			'seoRobotsIndex'           => array(AttributeType::Enum, 'values' => $robotsIndex,      'default' => $robotsIndex[0]),
			'seoRobotsFollow'          => array(AttributeType::Enum, 'values' => $robotsFollow,     'default' => $robotsFollow[0]),
			'seoSitemapPriority'       => array(AttributeType::Enum, 'values' => $sitemapPriority,  'default' => $sitemapPriority[0]),
		);

	}

	public function defineRelations()
	{
		return array(
			'element' => array(static::BELONGS_TO, 'ElementRecord', 'required' => true, 'onDelete' => static::CASCADE),
		);
	}
}
