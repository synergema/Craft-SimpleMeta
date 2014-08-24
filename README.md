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

##### How Fallback Works

The fallback will work as both a fallback if the entry doesn't exist, but will also act as a default to fill in values not present in the entry. So, for example, if you have a `description` in your fallback, but not in the entry, the `description` from the fallback will be output.

##### Title Tag

The `output` tag will no longer include the `<title>` tag. This will need to be implemented by you. Example forthcoming on how you can handle this.

### 2. Custom Template

You can access any of the `SimpleMeta` fields directy via the entry if you prefer to setup your own custom output. 

**A list of available field names coming soon.**