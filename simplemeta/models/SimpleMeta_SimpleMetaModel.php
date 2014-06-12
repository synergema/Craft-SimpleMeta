<?php
namespace Craft;

class SimpleMeta_SimpleMetaModel extends BaseModel
{
	protected function defineAttributes()
	{
		// Open Graph Types
		$openGraphTypes = array(
			'article',
			'profile',
			'video',
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
			'elementId'                => AttributeType::Number,
			'handle'                   => AttributeType::String,
			'socialOGTitle'            => AttributeType::String,
			'socialOGDescription'      => AttributeType::String,
			'socialOGType'             => array(AttributeType::Enum, 'values' => $openGraphTypes, 'default' => $openGraphTypes[0]),
			'socialTwitterTitle'       => AttributeType::String,
			'socialTwitterType'        => array(AttributeType::Enum, 'values' => $twitterCardTypes, 'default' => $twitterCardTypes[0]),
			'socialTwitterDescription' => AttributeType::String,
				// Twiter Card Type fields
				'socialTwitterAppCountry'    => AttributeType::String,
				'socialTwitterAppIphoneId'   => AttributeType::String,
				'socialTwitterAppIphoneUrl'  => AttributeType::String,
				'socialTwitterAppIpadId'     => AttributeType::String,
				'socialTwitterAppIpadUrl'    => AttributeType::String,
				'socialTwitterAppAndroidId'  => AttributeType::String,
				'socialTwitterAppAndroidUrl' => AttributeType::String,
				'socialTwitterProductData1'  => AttributeType::String,
				'socialTwitterProductLabel1' => AttributeType::String,
				'socialTwitterProductData2'  => AttributeType::String,
				'socialTwitterProductLabel2' => AttributeType::String,
			'seoTitle'                 => AttributeType::String,
			'seoDescription'           => AttributeType::String,
			'seoCanonicalUrl'          => AttributeType::String,
			'seoRobotsIndex'           => array(AttributeType::Enum, 'values' => $robotsIndex, 'default' => $robotsIndex[0]),
			'seoRobotsFollow'          => array(AttributeType::Enum, 'values' => $robotsFollow, 'default' => $robotsFollow[0]),
			'seoSitemapPriority'       => array(AttributeType::String, 'default' => '0.5'),
		);
	}
}
