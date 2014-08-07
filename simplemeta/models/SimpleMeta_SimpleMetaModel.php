<?php
namespace Craft;

class SimpleMeta_SimpleMetaModel extends BaseModel
{
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
				'elementId' => array(AttributeType::Number, 'default' => null),
				'handle'    => array(AttributeType::String, 'default' => null),
				// Open Graph
					'socialOGTitle'                   => array(AttributeType::String, 'default' => null),
					'socialOGDescription'             => array(AttributeType::String, 'default' => null),
					'socialOGImageId'                 => array(AttributeType::Number, 'default' => null), /* Asset */
					'socialOGType'                    => array(AttributeType::Enum, 'values' => $openGraphTypes, 'default' => $openGraphTypes[0]),
					// OG Video
					'socialOGVideoContentId'          => array(AttributeType::Number, 'default' => null), /* Asset */
					'socialOGVideoContentSecure'      => array(AttributeType::String, 'default' => null),
					'socialOGVideoEmbeddedUrl'        => array(AttributeType::String, 'default' => null),
					'socialOGVideoUrl'                => array(AttributeType::String, 'default' => null),
					'socialOGVideoType'               => array(AttributeType::String, 'default' => null),
					'socialOGVideoWidth'              => array(AttributeType::String, 'default' => null),
					'socialOGVideoHeight'             => array(AttributeType::String, 'default' => null),
					// OG Audio
					'socialOGAudioContentId'          => array(AttributeType::Number, 'default' => null), /* Asset */
					'socialOGAudioContentSecure'      => array(AttributeType::String, 'default' => null),
					'socialOGAudioEmbeddedUrl'        => array(AttributeType::String, 'default' => null),
					'socialOGAudioType'               => array(AttributeType::String, 'default' => null),
					// Article
					'socialOGArticle'                 => array(AttributeType::String, 'default' => null),
					// OG Music - Song
					'socialOGMusicSongDuration'       => array(AttributeType::String, 'default' => null),
					'socialOGMusicSongAlbum'          => array(AttributeType::String, 'default' => null),
					'socialOGMusicSongDisc'           => array(AttributeType::String, 'default' => null),
					'socialOGMusicSongTrack'          => array(AttributeType::String, 'default' => null),
					'socialOGMusicSongMusician'       => array(AttributeType::String, 'default' => null),
					// OG Music - Album
					'socialOGMusicAlbumSong'          => array(AttributeType::String, 'default' => null),
					'socialOGMusicAlbumDisc'          => array(AttributeType::String, 'default' => null),
					'socialOGMusicAlbumTrack'         => array(AttributeType::String, 'default' => null),
					'socialOGMusicAlbumMusician'      => array(AttributeType::String, 'default' => null),
					'socialOGMusicAlbumReleaseDate'   => array(AttributeType::DateTime, 'default' => null), // DateTime
					// OG Music - Playlist
					'socialOGMusicPlaylistSong'       => array(AttributeType::String, 'default' => null),
					'socialOGMusicPlaylistSongDisc'   => array(AttributeType::String, 'default' => null),
					'socialOGMusicPlaylistSongTrack'  => array(AttributeType::String, 'default' => null),
					'socialOGMusicPlaylistCreator'    => array(AttributeType::String, 'default' => null),
					// OG Music - Radio Station
					'socialOGMusicRadioStation'       => array(AttributeType::String, 'default' => null),
					// OG Profile
					'socialOGProfileFirstName'        => array(AttributeType::String, 'default' => null),
					'socialOGProfileLastName'         => array(AttributeType::String, 'default' => null),
					'socialOGProfileUsername'         => array(AttributeType::String, 'default' => null),
					'socialOGProfileGender'           => array(AttributeType::String, 'default' => null),
					// Video - Movie
					'socialOGVideoMovieActor'         => array(AttributeType::String, 'default' => null),
					'socialOGVideoMovieActorRole'     => array(AttributeType::String, 'default' => null),
					'socialOGVideoMovieDirector'      => array(AttributeType::String, 'default' => null),
					'socialOGVideoMovieWriter'        => array(AttributeType::String, 'default' => null),
					'socialOGVideoMovieDuration'      => array(AttributeType::String, 'default' => null),
					'socialOGVideoMovieRelaseDate'    => array(AttributeType::String, 'default' => null), // DateTime
					'socialOGVideoMovieTag'           => array(AttributeType::String, 'default' => null),
					// Video - Episode
					'socialOGVideoEpisodeActor'       => array(AttributeType::String, 'default' => null),
					'socialOGVideoEpisodeActorRole'   => array(AttributeType::String, 'default' => null),
					'socialOGVideoEpisodeDirector'    => array(AttributeType::String, 'default' => null),
					'socialOGVideoEpisodeWriter'      => array(AttributeType::String, 'default' => null),
					'socialOGVideoEpisodeDuration'    => array(AttributeType::String, 'default' => null),
					'socialOGVideoEpisodeReleaseDate' => array(AttributeType::String, 'default' => null), // DateTime
					'socialOGVideoEpisodeTag'         => array(AttributeType::String, 'default' => null),
					'socialOGVideoEpisodeSeries'      => array(AttributeType::String, 'default' => null),
					// Video - TV Show
					'socialOGVideoTVShowActor'        => array(AttributeType::String, 'default' => null),
					'socialOGVideoTVShowActorRole'    => array(AttributeType::String, 'default' => null),
					'socialOGVideoTVShowDirector'     => array(AttributeType::String, 'default' => null),
					'socialOGVideoTVShowWriter'       => array(AttributeType::String, 'default' => null),
					'socialOGVideoTVShowDuration'     => array(AttributeType::String, 'default' => null),
					'socialOGVideoTVShowRelaseDate'   => array(AttributeType::String, 'default' => null), // DateTime
					'socialOGVideoTVShowTag'          => array(AttributeType::String, 'default' => null),
					// Video - Other
					'socialOGVideoOtherActor'         => array(AttributeType::String, 'default' => null),
					'socialOGVideoOtherActorRole'     => array(AttributeType::String, 'default' => null),
					'socialOGVideoOtherDirector'      => array(AttributeType::String, 'default' => null),
					'socialOGVideoOtherWriter'        => array(AttributeType::String, 'default' => null),
					'socialOGVideoOtherDuration'      => array(AttributeType::String, 'default' => null),
					'socialOGVideoOtherRelaseDate'    => array(AttributeType::String, 'default' => null), // DateTime
					'socialOGVideoOtherTag'           => array(AttributeType::String, 'default' => null),
					// Website
					'socialOGWebsite'                 => array(AttributeType::String, 'default' => null),

				// Twitter
				'socialTwitterTitle'       => array(AttributeType::String, 'default' => null),
				'socialTwitterType'        => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
				'socialTwitterDescription' => array(AttributeType::String, 'default' => null),
					// Twiter App
					'socialTwitterAppCountry'          => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIphoneName'       => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIphoneId'         => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIphoneUrl'        => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIpadName'         => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIpadId'           => array(AttributeType::String, 'default' => null),
					'socialTwitterAppIpadUrl'          => array(AttributeType::String, 'default' => null),
					'socialTwitterAppAndroidName'      => array(AttributeType::String, 'default' => null),
					'socialTwitterAppAndroidId'        => array(AttributeType::String, 'default' => null),
					'socialTwitterAppAndroidUrl'       => array(AttributeType::String, 'default' => null),
					// Twiter Gallery
					'socialTwitterGalleryImagesId'     => array(AttributeType::Number, 'default' => null), /* Asset */
					// Twiter Photo
					'socialTwitterPhotoId'             => array(AttributeType::Number, 'default' => null), /* Asset */
					// Twiter Product
					'socialTwitterProductData1'        => array(AttributeType::String, 'default' => null),
					'socialTwitterProductLabel1'       => array(AttributeType::String, 'default' => null),
					'socialTwitterProductData2'        => array(AttributeType::String, 'default' => null),
					'socialTwitterProductLabel2'       => array(AttributeType::String, 'default' => null),
					'socialTwitterProductImageId'      => array(AttributeType::Number, 'default' => null), /* Asset */
					// Twiter Summary
					'socialTwitterSummaryImageId'      => array(AttributeType::Number, 'default' => null), /* Asset */
					// Twiter Summary w Large Image
					'socialTwitterSummaryLargeImageId' => array(AttributeType::Number, 'default' => null), /* Asset */
				
				// SEO
				'seoTitle'           => array(AttributeType::String, 'default' => null),
				'seoDescription'     => array(AttributeType::String, 'default' => null),
				'seoCanonicalUrl'    => array(AttributeType::String, 'default' => null),
				'seoRobotsIndex'     => array(AttributeType::Enum, 'values' => $robotsIndex, 'default' => $robotsIndex[0]),
				'seoRobotsFollow'    => array(AttributeType::Enum, 'values' => $robotsFollow, 'default' => $robotsFollow[0]),
				'seoSitemapPriority' => array(AttributeType::String, 'default' => '0.5'),
		);
	}
}
