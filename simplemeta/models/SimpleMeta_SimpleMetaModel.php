<?php
namespace Craft;

class SimpleMeta_SimpleMetaModel extends BaseModel
{
	protected function defineAttributes()
	{

		// Open Graph Types
		$openGraphTypes = array(
			OpenGraphTypes::Article,
			OpenGraphTypes::Book,
			OpenGraphTypes::MusicSong,
			OpenGraphTypes::MusicAlbum,
			OpenGraphTypes::MusicPlaylist,
			OpenGraphTypes::MusicRadioStation,
			OpenGraphTypes::Profile,
			OpenGraphTypes::VideoMovie,
			OpenGraphTypes::VideoEpisode,
			OpenGraphTypes::VideoTvShow,
			OpenGraphTypes::Website,
		);

		// Twitter Card Types
		$twitterCardTypes = array(
			TwitterCardTypes::Summary,
			TwitterCardTypes::SummaryLargeImage,
			TwitterCardTypes::Photo,
			TwitterCardTypes::Product,
			TwitterCardTypes::App,
			TwitterCardTypes::Player,
		);

		// Robots Index
		$robotsIndex = array(
			RobotsIndex::Index,
			RobotsIndex::NoIndex,
		);

		// Robots Follow
		$robotsFollow = array(
			RobotsFollow::Follow,
			RobotsFollow::NoFollow,
		);

		return array(
			'smSocialOGTitle'            => AttributeType::String,
			'smSocialOGType'             => array(AttributeType::Enum, 'default' => OpenGraphTypes::Article,   'values' => $openGraphTypes),
			'smSocialOGDescription'      => AttributeType::String,
			'smSocialTwitterTitle'       => AttributeType::String,
			'smSocialTwitterType'        => array(AttributeType::Enum, 'default' => TwitterCardTypes::Summary, 'values' => $twitterCardTypes),
			'smSocialTwitterDescription' => AttributeType::String,
			'smSEOTitle'                 => AttributeType::String,
			'smSEODescription'           => AttributeType::String,
			'smSEOCanonicalUrl'          => AttributeType::String,
			'smSEORobotsIndex'           => array(AttributeType::Enum, 'default' => RobotsIndex::Index,        'values' => $robotsIndex),
			'smSEORobotsFollow'          => array(AttributeType::Enum, 'default' => RobotsFollow::Follow,      'values' => $robotsFollow),
		);

	}
}
