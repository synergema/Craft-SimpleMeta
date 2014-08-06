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
			'audio',
			'profile',
			'video.movie',
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
				'handle'                         => AttributeType::String,
				'socialOGTitle'                  => AttributeType::String,
				'socialOGDescription'            => AttributeType::String,
				'socialOGType'                   => array(AttributeType::Enum, 'values' => $openGraphTypes, 'default' => $openGraphTypes[0]),
					// Open Graph Type fields
					'socialOGAudioContentSecure'     => AttributeType::String,
					'socialOGAudioType'              => AttributeType::String,
					'socialOGProfileFirstName'       => AttributeType::String,
					'socialOGProfileLastName'        => AttributeType::String,
					'socialOGProfileUsername'        => AttributeType::String,
					'socialOGProfileGender'          => AttributeType::String,
					'socialOGVideoContentSecure'     => AttributeType::String,
					'socialOGVideoUrl'				 => AttributeType::String,
					'socialOGVideoType'              => AttributeType::String,
					'socialOGVideoWidth'             => AttributeType::String,
					'socialOGVideoHeight'            => AttributeType::String,
				'socialTwitterTitle'             => AttributeType::String,
				'socialTwitterType'              => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
				'socialTwitterDescription'       => AttributeType::String,
					// Twiter Card Type fields
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
					'socialTwitterProductData1'   => AttributeType::String,
					'socialTwitterProductLabel1'  => AttributeType::String,
					'socialTwitterProductData2'   => AttributeType::String,
					'socialTwitterProductLabel2'  => AttributeType::String,
				'seoTitle'                       => AttributeType::String,
				'seoDescription'                 => AttributeType::String,
				'seoCanonicalUrl'                => AttributeType::String,
				'seoRobotsIndex'                 => array(AttributeType::Enum, 'values' => $robotsIndex, 'default' => $robotsIndex[0]),
				'seoRobotsFollow'                => array(AttributeType::Enum, 'values' => $robotsFollow, 'default' => $robotsFollow[0]),
				'seoSitemapPriority'             => array(AttributeType::String, 'default' => '0.5'),
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
