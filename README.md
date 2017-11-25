# Unwritten Future Wordpress Theme

Wordpress theme based on [Unwritten Future](https://github.com/jkissam/unwritten_future/) front-end framework

Built-in CSS includes:

* reset.css
* Bootstrap grid system (but no other bootstrap styling)
* Horizontal Swath sidebar region for building parallax-style sites/themes
* Special "utility" section which will render just above the footer on mobile but which is placed in upper-right-hand corner on tablets & desktop by media query

Javascript/CSS functionality includes:

* Responsive menu with touch-friendly drop-downs
* Dismissable messages
* Modals, which are openable by linking to their ids or programatically through Javascript
* Option to fix footer to the bottom of the page when content doesn't push it that far

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