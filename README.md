# Unwritten Future Wordpress Theme

Wordpress theme based on [Unwritten Future](https://github.com/jkissam/unwritten_future/) front-end framework

_Version 1.2.3_  
_Latest update: 2018-11-13_

## Shortcodes

### [post-summary]

* Displays one or more post summaries using WP_Query
* Attributes can be any of the [parameters for WP_Query](https://codex.wordpress.org/Class_Reference/WP_Query#Parameters) EXCEPT fields and those which require associative arrays: `tax_query`, `date_query`, `meta_query` and the `orderby` array option
* Parameters which take simple arrays should have arguments separated by commas

### [html]

* Removes `wpautop` (i.e., automatic line breaks & paragraphs) from enclosed content - helpful for adding in complex HTML without a bunch of pesky extra line breaks

## Built-in CSS/HTML includes:

* reset.css
* Bootstrap grid system (but no other bootstrap styling)
* option to load [Wordpress dashicons](https://developer.wordpress.org/resource/dashicons/) into front-end theme
* Horizontal Swath "sidebar" region for building parallax-style displays
* Special "utility" section which will render just above the footer on mobile but which is placed in upper-right-hand corner on tablets & desktop by media query (useful for secondary menus or social media links)

## Javascript/CSS functionality includes:

* Responsive menu with touch-friendly drop-downs
* Modals, which are openable by linking to their ids or programatically through Javascript
* Option to fix footer to the bottom of the page when content doesn't push it that far
* option to load [javascript libraries bundled with Wordpress](https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress) into front-end theme
* adding the `uwf-input-label` class to an `input` or `textarea` element, or to any parent of an input or textarea element, will display the label over the element (i.e., like a placeholder), but use css transitions to move it to smaller text immediately above the input when the input/textarea has focus or content. Will not affect checkbox, radio or submit input types

## Additional optional Javascript functionality:

* create on-the-fly "on this page" navigation based on `h2` elements (or any other header, as set in theme options) in the main blog post
* shorten links that are wider than their parents (i.e., when long URLs are used as the link text, which can break mobile layouts)
* open links to external URLs in a new window, optionally excluding by jQuery selectors
* make links to anchors in the same page scroll rather than jump (do this by adding a class)
* helper functions to set and get cookies
* populate inputs with the value of their labels
* prepare pop-ups
* add class "fixed" to a particular element when the page scrolls past a certain number of pixels
* equalize the height of a set of matched elements
* scroll the page to include a particular element
* vertically center an element relative to another element
* smartresize event

## Changelog

__November 13, 2018__ : Upgrade to version 1.2.3. Added `max-width: 100%` to `wp-caption` class so that image captions are constrained to fit inside their containers.

__July 20, 2018__ : Upgrade to version 1.2.2. Updated with Version 1.1.3 of [Unwritten Future HTML Framework](https://github.com/jkissam/unwritten_future/), which contains some small extra features on navigation javascript, and implements one of them (choosing element to search for "on this page" content) in Wordpress theme options.

__January 6, 2018__ : Upgrade to version 1.2.1:

* Any link to `#search` will open search box in a modal (without having to place a widget)
* Updated with Version 1.1.2 of [Unwritten Future HTML Framework](https://github.com/jkissam/unwritten_future/), which contains small improvements on navigation javascript
* Replaced references to "tldr" (a previous Wordpress theme some of the code was taken from) with "uwf" in content.php
* Documented shortcodes in README.md

__December 24, 2017__ : Updated with the latest version of the Unwritten Future HTML Framework, which fixes the `uwf-input-label` class

__December 18, 2017__ : Updated with the latest version of the Unwritten Future HTML Framework, which adds a `uwf-input-label` class

__December 14, 2017__ : Upgrade to version 1.2, which adds theme options to make the "highlighted" and "swaths" sidebars appear only on the front page, to hide the "sidebar" sidebar on the front page, and to control the css grid column widths of the content and "sidebar"

__December 13, 2017__ : Upgrade to version 1.1, which includes functions to load dashicons and WP javascript libraries, site credit, and properly implements "swaths" sidebar region