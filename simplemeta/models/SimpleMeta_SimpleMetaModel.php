<?php
namespace Craft;

class SimpleMeta_SimpleMetaModel extends BaseModel
{
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
				'elementId' => AttributeType::Number,
				'handle'    => AttributeType::String,
				// Open Graph
					'socialOGTitle'                    => AttributeType::String,
					'socialOGDescription'              => AttributeType::String,
					'socialOGImageId'                  => AttributeType::Number, /* Asset */
					'socialOGType'                     => array(AttributeType::Enum, 'values' => $openGraphTypes, 'default' => $openGraphTypes[0]),
					// OG Video
					'socialOGVideoInclude'             => AttributeType::Number,
					//'socialOGVideoContentId'           => AttributeType::Number, /* Asset */
					//'socialOGVideoContentSecure'       => AttributeType::Number,
					'socialOGVideoEmbeddedUrl'         => AttributeType::String,
					//'socialOGVideoUrl'                 => AttributeType::String,
					//'socialOGVideoType'                => AttributeType::String,
					//'socialOGVideoWidth'               => AttributeType::String,
					//'socialOGVideoHeight'              => AttributeType::String,
					// OG Audio
					//'socialOGAudioInclude'             => AttributeType::Number,
					//'socialOGAudioContentId'           => AttributeType::Number, /* Asset */
					//'socialOGAudioContentSecure'       => AttributeType::Number,
					//'socialOGAudioEmbeddedUrl'         => AttributeType::String,
					//'socialOGAudioType'                => AttributeType::String,
					// Article
					//'socialOGArticle'                  => AttributeType::String,
					//// Book
					//'socialOGBook'                     => AttributeType::String,
					//// OG Music - Song
					//'socialOGMusicSongDuration'        => AttributeType::String,
					//'socialOGMusicSongAlbum'           => AttributeType::String,
					//'socialOGMusicSongDisc'            => AttributeType::String,
					//'socialOGMusicSongTrack'           => AttributeType::String,
					//'socialOGMusicSongMusician'        => AttributeType::String,
					//// OG Music - Album
					//'socialOGMusicAlbumSong'           => AttributeType::String,
					//'socialOGMusicAlbumDisc'           => AttributeType::String,
					//'socialOGMusicAlbumTrack'          => AttributeType::String,
					//'socialOGMusicAlbumMusician'       => AttributeType::String,
					//'socialOGMusicAlbumReleaseDate'    => AttributeType::DateTime, // DateTime
					//// OG Music - Playlist
					//'socialOGMusicPlaylistSong'        => AttributeType::String,
					//'socialOGMusicPlaylistSongDisc'    => AttributeType::String,
					//'socialOGMusicPlaylistSongTrack'   => AttributeType::String,
					//'socialOGMusicPlaylistCreator'     => AttributeType::String,
					//// OG Music - Radio Station
					//'socialOGMusicRadioStationCreator' => AttributeType::String,
					//// OG Profile
					//'socialOGProfileFirstName'         => AttributeType::String,
					//'socialOGProfileLastName'          => AttributeType::String,
					//'socialOGProfileUsername'          => AttributeType::String,
					//'socialOGProfileGender'            => AttributeType::String,
					//// Video - Movie
					//'socialOGVideoMovieActor'          => AttributeType::String,
					//'socialOGVideoMovieActorRole'      => AttributeType::String,
					//'socialOGVideoMovieDirector'       => AttributeType::String,
					//'socialOGVideoMovieWriter'         => AttributeType::String,
					//'socialOGVideoMovieDuration'       => AttributeType::String,
					//'socialOGVideoMovieReleaseDate'    => AttributeType::DateTime, // DateTime
					//'socialOGVideoMovieTag'            => AttributeType::String,
					//// Video - Episode
					//'socialOGVideoEpisodeActor'        => AttributeType::String,
					//'socialOGVideoEpisodeActorRole'    => AttributeType::String,
					//'socialOGVideoEpisodeDirector'     => AttributeType::String,
					//'socialOGVideoEpisodeWriter'       => AttributeType::String,
					//'socialOGVideoEpisodeDuration'     => AttributeType::String,
					//'socialOGVideoEpisodeReleaseDate'  => AttributeType::DateTime, // DateTime
					//'socialOGVideoEpisodeTag'          => AttributeType::String,
					//'socialOGVideoEpisodeSeries'       => AttributeType::String,
					//// Video - TV Show
					//'socialOGVideoTVShowActor'         => AttributeType::String,
					//'socialOGVideoTVShowActorRole'     => AttributeType::String,
					//'socialOGVideoTVShowDirector'      => AttributeType::String,
					//'socialOGVideoTVShowWriter'        => AttributeType::String,
					//'socialOGVideoTVShowDuration'      => AttributeType::String,
					//'socialOGVideoTVShowReleaseDate'    => AttributeType::DateTime, // DateTime
					//'socialOGVideoTVShowTag'           => AttributeType::String,
					//// Video - Other
					//'socialOGVideoOtherActor'          => AttributeType::String,
					//'socialOGVideoOtherActorRole'      => AttributeType::String,
					//'socialOGVideoOtherDirector'       => AttributeType::String,
					//'socialOGVideoOtherWriter'         => AttributeType::String,
					//'socialOGVideoOtherDuration'       => AttributeType::String,
					//'socialOGVideoOtherReleaseDate'     => AttributeType::DateTime, // DateTime
					//'socialOGVideoOtherTag'            => AttributeType::String,
					//// Website
					//'socialOGWebsite'                  => AttributeType::String,

				// Twitter
				'socialTwitterTitle'       => AttributeType::String,
				'socialTwitterType'        => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
				'socialTwitterDescription' => AttributeType::String,
					// Twiter App
					'socialTwitterAppCountry'          => AttributeType::String,
					'socialTwitterAppIphoneName'       => AttributeType::String,
					'socialTwitterAppIphoneId'         => AttributeType::String,
					'socialTwitterAppIphoneUrl'        => AttributeType::String,
					'socialTwitterAppIpadName'         => AttributeType::String,
					'socialTwitterAppIpadId'           => AttributeType::String,
					'socialTwitterAppIpadUrl'          => AttributeType::String,
					'socialTwitterAppAndroidName'      => AttributeType::String,
					'socialTwitterAppAndroidId'        => AttributeType::String,
					'socialTwitterAppAndroidUrl'       => AttributeType::String,
					// Twiter Gallery
					'socialTwitterGalleryImagesId'     => AttributeType::Number, /* Asset */
					// Twiter Photo
					'socialTwitterPhotoId'             => AttributeType::Number, /* Asset */
					// Twiter Product
					'socialTwitterProductData1'        => AttributeType::String,
					'socialTwitterProductLabel1'       => AttributeType::String,
					'socialTwitterProductData2'        => AttributeType::String,
					'socialTwitterProductLabel2'       => AttributeType::String,
					'socialTwitterProductImageId'      => AttributeType::Number, /* Asset */
					// Twiter Summary
					'socialTwitterSummaryImageId'      => AttributeType::Number, /* Asset */
					// Twiter Summary w Large Image
					'socialTwitterSummaryLargeImageId' => AttributeType::Number, /* Asset */

				// SEO
				'seoTitle'           => AttributeType::String,
				'seoDescription'     => AttributeType::String,
				'seoCanonicalUrl'    => AttributeType::String,
				'seoRobotsIndex'     => array(AttributeType::Enum, 'values' => $robotsIndex, 'default' => $robotsIndex[0]),
				'seoRobotsFollow'    => array(AttributeType::Enum, 'values' => $robotsFollow, 'default' => $robotsFollow[0]),
				'seoSitemapPriority' => array(AttributeType::String, 'default' => '0.5'),
		);
	}
}
