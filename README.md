# SimpleMeta for Craft CMS

Making meta implementation for your [Craft CMS](http://buildwithcraft.com) sites slightly less painless.

-----

**SimpleMeta** provides you with the following tools:

1. SimpleMeta fieldtype.
2. Front-end template tag for outputting meta data.

## Install

1. Copy the `simplemeta` directory into your site's plugins directory, usually `craft/plugins`.
2. Install the plugin in your site's control panel.

## Field Setup

Create a new `SimpleMeta` field and include it any any field layout you would like. We recommend creating a new tab called "Meta" (or whatever you prefer) and including the `SimpleMeta` field there. There are quite a few options. The meta data is then stored with the entry.

## Front-End Implementation

There are two ways to output the meta in your template:

### 1. Output Tag

Use the `output` method included. This outputs all meta in one handy-dandy tag, with a little bit of work from you the developer.

	{{ craft.simpleMeta.output(entry, fallback)|raw }}

This requires one parameter, `entry`, with an optional second `fallback` parameter. The `entry` parameter should be the current page entry. The `fallback` parameter would be used in cases where there isn't an entry. We recommend creating a global with an instance of the `SimpleMeta` field for your fallback. This essentially provides default meta data for those cases where an entry isn't available. You also then have the ability to create more than fallback if you need to. We leave this implementation up to you.

#### Example Output Tag Usage

This example assumes that you have a global entry with a handle of `metaFallback` with an instance of the `SimpleMeta` fieldtype.

```
{% set entry = entry is defined ? entry %}
{% set fallback = craft.globals.getSetByHandle('metaFallback') %}
{{ craft.simpleMeta.output(entry, fallback)|raw }}
```


### 2. Custom Template

You can access any of the `SimpleMeta` fields directy via the entry if you prefer to setup your own custom output.

#### Open Graph Tags

[http://ogp.me/](http://ogp.me/)

##### General

Property      | Tag           | Returns
------------- | ------------- | ------------
Title         | `{{ entry.fieldHandle.socialOGTitle }}`            | String
Description   | `{{ entry.fieldHandle.socialOGDescription }}`      | String
Image         | `{{ entry.fieldHandle.socialOGImageId }}`          | Asset ID
Type          | `{{ entry.fieldHandle.socialOGType }}`             | String

##### Video

Property      | Tag           | Returns
------------- | ------------- | ------------
Include Video | `{{ entry.fieldHandle.socialOGVideoInclude }}`     | String
Video         | `{{ entry.fieldHandle.socialOGVideoEmbeddedUrl }}` | String


#### Twitter Tags

[https://dev.twitter.com/docs/cards](https://dev.twitter.com/docs/cards)

##### General

Property      | Tag           | Returns
------------- | ------------- | ------------
Title         | `{{ entry.fieldHandle.socialTwitterTitle }}`       | String 
Description   | `{{ entry.fieldHandle.socialTwitterDescription }}` | String
Type          | `{{ entry.fieldHandle.socialTwitterType }}`        | String

##### Summary Card

Property      | Tag           | Returns
------------- | ------------- | ------------
Image         | `{{ entry.fieldHandle.socialTwitterSummaryImageId }}` | Asset ID

##### Summary Card w/ Large Image

Property      | Tag           | Returns
------------- | ------------- | ------------
Image         | `{{ entry.fieldHandle.socialTwitterSummaryLargeImageId }}` | Asset ID

##### Photo Card

Property      | Tag           | Returns
------------- | ------------- | ------------
Image         | `{{ entry.fieldHandle.socialTwitterPhotoId }}` | Asset ID

##### App Card

Property             | Tag           | Returns
-------------------- | ------------- | ------------
App Name iPhone      | `{{ entry.fieldHandle.socialTwitterAppIphoneName }}`  | String
App ID iPhone        | `{{ entry.fieldHandle.socialTwitterAppIphoneId }}`    | String
App URL iPhone       | `{{ entry.fieldHandle.socialTwitterAppIphoneUrl }}`   | String
App Name iPad        | `{{ entry.fieldHandle.socialTwitterAppIpadName }}`    | String
App ID iPad          | `{{ entry.fieldHandle.socialTwitterAppIpadId }}`      | String
App URL iPad         | `{{ entry.fieldHandle.socialTwitterAppIpadUrl }}`     | String
App ID Google Play   | `{{ entry.fieldHandle.socialTwitterAppAndroidName }}` | String
App Name Google Play | `{{ entry.fieldHandle.socialTwitterAppAndroidId }}`   | String
App URL Google Play  | `{{ entry.fieldHandle.socialTwitterAppAndroidUrl }}`  | String
App Country          | `{{ entry.fieldHandle.socialTwitterAppCountry }}`     | String

##### Product Card

Property      | Tag           | Returns
------------- | ------------- | ------------
Image         | `{{ entry.fieldHandle.socialTwitterProductImageId }}` | Asset ID
Label 1       | `{{ entry.fieldHandle.socialTwitterProductLabel1 }}`  | String
Data 1        | `{{ entry.fieldHandle.socialTwitterProductData1 }}`   | String
Label 2       | `{{ entry.fieldHandle.socialTwitterProductLabel2 }}`  | String
Data 2        | `{{ entry.fieldHandle.socialTwitterProductData2 }}}`  | String

#### SEO

Property         | Tag           | Returns
---------------- | ------------- | ------------
Title            | `{{ entry.fieldHandle.seoTitle }}`           | String
Description      | `{{ entry.fieldHandle.seoDescription }}`     | String
Canonical URL    | `{{ entry.fieldHandle.seoCanonicalUrl }}`    | String
Robots Index     | `{{ entry.fieldHandle.seoRobotsIndex }}`     | String
Robots Follow    | `{{ entry.fieldHandle.seoRobotsFollow }}`    | String
Sitemap Priority | `{{ entry.fieldHandle.seoSitemapPriority }}` | String