=== Social Dropdown ===
Contributors: multippt
Tags: post, social bookmark, bookmark, accessibility
Requires at least: 1.5
Tested up to: 2.3.1
Stable tag: 1.3.1
Donate link: http://www.tevine.com/donate.php

This plugin displays several social bookmarking in a dropdown. Unlike other social bookmarking displays, this does not cause clutter.

== Description ==

This plugin displays several social bookmarking options in a dropdown. Unlike other social bookmarking displays, this does not cause clutter.

Supported Social Bookmarks are:

* BlinkBits
* BlinkList
* BlogLines
* BlogMarks
* CiteULike
* Co.mments
* Del.icio.us
* Digg
* Diigo
* Fark
* Feed Me Links
* Furl
* Google Bookmarks
* Linkagogo
* Ma.gnolia
* NetVouz
* Newsvine
* Propeller (replaces Netscape)
* RawSugar
* Reddit
* Rojo
* Simpy
* Sphinn
* Spurl
* Squidoo
* StumbleUpon
* TailRank
* Technorati
* Yahoo MyWebs

In addition, you can customize the order of the bookmarks or choose to remove some of them without editing a file.

== Installation ==

By installing the plugin, you agree to [Tevine's policies](http://www.tevine.com/policies.php "Tevine's Policies").

1. Upload the "socialdropdown" folder into the "/wp-content/plugins/" directory. The folder should consist of several files and folders:

* readme.txt
* LICENSE.txt
* ajax.js
* configinterface.php
* dropdown.js
* generatebookmarks.php
* style.css
* socialdropdown.php
* icons/
* thescripts/

2. Login to your Wordpress Administration Panel

3. Go to the plugins tab, and activate the "Social Dropdown" plug-in. If there are no error messages, the plugin is properly installed.

4. Insert `<?php Show_Dropdown(); ?>` at where you want the social bookmarks to be displayed. This line of code should be placed within the Wordpress loop (i.e. the place where your posts appear).

5. You can rearrange, add and remove bookmarks via the `Options > Social Dropdown` panel.

Feel free to poke around the internals of the plug-in.

== Updating ==

You can check what version the plug-in is at via visiting the `Options > Social Dropdown` panel.

1. Deactivate the `Social Dropdown` plug-in. You may want to back-up your existing plug-in files.

2. Replace the files in the `socialdropdown` directory located in the Wordpress plug-ins directory

3. Activate the `Social Dropdown` plug-in

If you have modified the `GenerateAll()` function, copy the modified area and set `$overrideoptions` to `true` to preserve your changes. `$overrideoptions` can be found in `generatebookmarks.php`.

== Requirements ==

1. A working Wordpress install

2. Your WordPress theme must contain a call to the `get_header()` function

3. Your WordPress theme must contain the Wordpress loop

Most Wordpress installs and templates have these, so you need not worry about these.

In addition, to be able to use the dropdown, one must have JavaScript enabled in the browser. 
However, users without JavaScript installed will see a list of social bookmarks at where the dropdown is.

== Customizing ==

Within `socialdropdown.php`, these are some areas you can edit to influence how the dropdown appears.

In the `GenerateAll()` function, you can re-arrange how the items appear, add new items or remove them (after setting `$overrideoptions` to `true`). You can already do this using the `Options > Social Dropdown panel`.

** Creating bookmarks **
Each social bookmark is generated using the `GenerateLink()` function, and the URLs used are created using the `GenerateURL()` function. The parameters are as followed: GenerateLink($type), where $type is the name of the social bookmark (e.g. Digg is represented as 'digg').
In order to add a new bookmark, add the following lines of code after an item [i.e. after `break;`] in the **GenerateURL()** function. An example is shown:

	case '[name of social bookmarking site]':
	?>
	[URL to social bookmark page]
	<?php
	break;

In this example, when you call `GenerateURL('yahoo')`, the link for this item is generated. The link is the direct link to the submitting URL, usually available as an API on the social bookmarking site. Within the URL, there is some PHP code. `the_title()` represents the post title, while `echo get_the_permalink()` represents the URL of the post.

After adding the PHP stuff, don't forget to put in `GenerateLink('[name of social bookmark site]')` in `GenerateAll()`

== Frequently Asked Questions ==

**How do you re-arrange bookmarks?**
Version 1.30 and above of this plug-in supports the customization of bookmarks. In order to customize your bookmarks, use the drag and drop feature in `Options > Social Dropdown`.

**There's something wrong with your plugin**
If you found any problems, please reach me at ready725 at gmail. 

== Screenshots ==

Some available screenshots can be found at the [plug-in page](http://www.tevine.com/projects/socialdropdown/ "Social Dropdown") in Tevine.

== Credits ==

1 image is taken from http://www.famfamfam.com/. Several images are created or taken from the corresponding social bookmarking sites and edited to suit the plug-in. The dropdown javascript is taken from http://www.dynamicdrive.com/ and modified. The drag-drop library is provided by script.aculo.us.

== Changelog ==

* 1.3.1 - Added file checks.
* 1.3.0 - Allowed for configuration of bookmarks via `Options > Social Dropdown`. [Currently in testing.]
* 1.2.2 - Link optimisation. Now allows for the disabling of the link back to the plugin's homepage.
* 1.2.1 - Link optimisation; now the plugin has little negative impact on the site's SEO and has reduced link leakage. Fixed the link to point to plugin's main page. Added customization of styles. Allowed for a customized dropdown "on" state. Added black colored theme.
* 1.2.0 - Link optimisation. Addition of 10 other social bookmarks. Addition of update notification
* 1.1.0 - Bug-fixes in layout which may cause problems to users viewing the plugin without JavaScript. Plugin now validates in W3 validator. 
* 1.0.0 - Initial
