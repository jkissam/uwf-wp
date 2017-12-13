# Unwritten Future Wordpress Theme

Wordpress theme based on [Unwritten Future](https://github.com/jkissam/unwritten_future/) front-end framework

_Latest update: Version 1.1, 2017-12-13_

Built-in CSS includes:

* reset.css
* Bootstrap grid system (but no other bootstrap styling)
* option to load [Wordpress dashicons](https://developer.wordpress.org/resource/dashicons/) into front-end theme
* Horizontal Swath "sidebar" region for building parallax-style displays on the front page
* Special "utility" section which will render just above the footer on mobile but which is placed in upper-right-hand corner on tablets & desktop by media query (useful for secondary menus or social media links)

Javascript/CSS functionality includes:

* Responsive menu with touch-friendly drop-downs
* Dismissable messages
* Modals, which are openable by linking to their ids or programatically through Javascript
* Option to fix footer to the bottom of the page when content doesn't push it that far
* option to load [javascript libraries bundled with Wordpress](https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress) into front-end theme

Additional optional Javascript functionality:

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

__December 13, 2017__ : Upgrade to version 1.1, which includes functions to load dashicons and WP javascript libraries, site credit, and properly implements "swaths" sidebar region