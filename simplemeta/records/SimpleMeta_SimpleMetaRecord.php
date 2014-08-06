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
			'music.song',
			'music.album',
			'music.playlist',
			'music.radio_station',
			'profile',
			'video.movie',
			'video.episode',
			'video.tv_show',
			'video.other',
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
				'handle' => AttributeType::String,
				// Open Graph
					'socialOGTitle'                 => AttributeType::String,
					'socialOGDescription'           => AttributeType::String,
					'socialOGType'                  => array(AttributeType::Enum, 'values' => $openGraphTypes, 'default' => $openGraphTypes[0]),
					// OG Video
					'socialOGVideoContentSecure'    => AttributeType::String,
					'socialOGVideoUrl'              => AttributeType::String,
					'socialOGVideoType'             => AttributeType::String,
					'socialOGVideoWidth'            => AttributeType::String,
					'socialOGVideoHeight'           => AttributeType::String,
					// OG Audio
					'socialOGAudioContentSecure'    => AttributeType::String,
					'socialOGAudioType'             => AttributeType::String,
					// OG Music - Album
					'socialOGMusicAlbumSong'        => AttributeType::String,
					'socialOGMusicAlbumDisc'        => AttributeType::String,
					'socialOGMusicAlbumTrack'       => AttributeType::String,
					'socialOGMusicAlbumMusician'    => AttributeType::String,
					'socialOGMusicAlbumReleaseDate' => AttributeType::DateTime,
					// OG Music - Song
					'socialOGMusicSongDuration'     => AttributeType::String,
					'socialOGMusicSongAlbum'        => AttributeType::String,
					'socialOGMusicSongDisc'         => AttributeType::String,
					'socialOGMusicSongTrack'        => AttributeType::String,
					'socialOGMusicSongMusician'     => AttributeType::String,
					// OG Profile
					'socialOGProfileFirstName'      => AttributeType::String,
					'socialOGProfileLastName'       => AttributeType::String,
					'socialOGProfileUsername'       => AttributeType::String,
					'socialOGProfileGender'         => AttributeType::String,
				
				// Twitter	
				'socialTwitterTitle'       => AttributeType::String,
				'socialTwitterType'        => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
				'socialTwitterDescription' => AttributeType::String,
					// Twiter App
					'socialTwitterAppCountry'     => AttributeType::String,
					'socialTwitterAppIphoneName'  => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIphoneId'    => AttributeType::String,
					'socialTwitterAppIphoneUrl'   => AttributeType::String,
					'socialTwitterAppIpadName'    => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIpadId'      => AttributeType::String,
					'socialTwitterAppIpadUrl'     => AttributeType::String,
					'socialTwitterAppAndroidName' => array(AttributeType::String, 'default' => null),
					'socialTwitterAppAndroidId'   => AttributeType::String,
					'socialTwitterAppAndroidUrl'  => AttributeType::String,
					// Twitter Product
					'socialTwitterProductData1'   => AttributeType::String,
					'socialTwitterProductLabel1'  => AttributeType::String,
					'socialTwitterProductData2'   => AttributeType::String,
					'socialTwitterProductLabel2'  => AttributeType::String,
				
				// SEO
				'seoTitle'           => AttributeType::String,
				'seoDescription'     => AttributeType::String,
				'seoCanonicalUrl'    => AttributeType::String,
				'seoRobotsIndex'     => array(AttributeType::Enum, 'values' => $robotsIndex, 'default' => $robotsIndex[0]),
				'seoRobotsFollow'    => array(AttributeType::Enum, 'values' => $robotsFollow, 'default' => $robotsFollow[0]),
				'seoSitemapPriority' => array(AttributeType::String, 'default' => '0.5'),
		);

	}

	public function defineRelations()
	{
		return array(
			'element'                        => array(static::BELONGS_TO, 'ElementRecord', 'required' => true, 'onDelete' => static::CASCADE),
			'socialOGImage'                  => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialOGAudioContent'           => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialOGVideoContent'           => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialTwitterGalleryImages'     => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialTwitterPhoto'             => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialTwitterProductImage'      => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialTwitterSummaryImage'      => array(static::BELONGS_TO, 'AssetFileRecord'),
			'socialTwitterSummaryLargeImage' => array(static::BELONGS_TO, 'AssetFileRecord'),
		);
	}
}
