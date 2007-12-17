<?php
/*
Plugin Name: Social Dropdown
Plugin URI: http://www.tevine.com/projects/socialdropdown
Description: Displays social bookmarks in a dropdown to reduce clutter
Author: Nicholas Kwan (multippt)
Author URI: http://www.tevine.com/
Version: 1.22
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
*/

/*  Copyright 2007  Nicholas Kwan  (email : ready725@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$dropdownversion = '1.22';

function Dropdown_header() {
?>

<link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/style.css" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/dropdown.js"></script>
<?php
}


$dropdown_linkback = 'true';

//Install options
add_option('dropdown_allowlinkback', $dropdown_linkback, 'Allows a link back to the plugin page [Social Dropdown]');

if (get_option('dropdown_allowlinkback') == '') {
	update_option('dropdown_allowlinkback', $dropdown_linkback);
}

if (get_option('dropdown_allowlinkback') != $dropdown_linkback) {
	$dropdown_linkback = get_option('dropdown_allowlinkback');
}

function Dropdown_optionspage() {
	switch ($task) {
	case '':
//Options page
?>
<div class="wrap">
<h2><?php _e('Social Dropdown configuration'); ?></h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
</p>
<p><?php _e('You can configure some options through this panel.'); ?></p>
<h3>Common settings</h3>
<p>Display a link to the plugin's homepage. You can set this to no, but a link would be appreciated. :)<br />
<input type="radio" name="dropdown_allowlinkback" id="dropdown_allowlinkback" value="true" <?php if (get_option('dropdown_allowlinkback') == 'true') { echo ' checked="checked"'; } ?> /><?php _e('Yes'); ?><br />
<input type="radio" name="dropdown_allowlinkback" id="dropdown_allowlinkback" value="false" <?php if (get_option('dropdown_allowlinkback') != 'true') { echo ' checked="checked"'; } ?> /><?php _e('No'); ?></p>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="dropdown_allowlinkback" />



<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
</p>
<h3>Version information</h3>
<p>If you want to edit the plugin, please edit the <code>socialdropdown.php</code> file to rearrange the bookmarks, or edit <code>style.css</code> to change the styles of the plugin. These files should reside in the socialdropdown folder</p>
<?php Dropdown_Updatecheck(); ?>
</form>

</div>
<?php
	break;
	}
}

function Dropdown_Updatecheck() {
global $dropdownversion;
//Checks for an update
$fp = fsockopen("www.tevine.com", 80, $errno, $errstr, 30) or die('');
if (!$fp) {
    echo "<p>Sorry, but the plugin cannot be checked if it is the latest revision. </p>\n";
} else {
    $out = "GET /projects/socialdropdown/latest.txt HTTP/1.1\r\n";
    $out .= "Host: www.tevine.com\r\n";
    $out .= "Connection: Close\r\n\r\n";

    fwrite($fp, $out);
$fitm = '';
    while (!feof($fp)) {
        $fitm .= fread($fp, 128);
    }
    fclose($fp);
}
      // strip the headers
      $pos      = strpos($fitm, "\r\n\r\n");
      $response = substr($fitm, $pos + 4);
	$response = (string) $response;
if ($response != $dropdownversion) {
	echo '<p>A newer version is available - '.$response.'. Please <a href="http://www.tevine.com/projects/socialdropdown/" title="Social Dropdown downloa">update</a>.</p>';
} else {
	echo '<p>You are currently using the latest version.</p>';
}
}


function Dropdown_options() {
	if (function_exists('add_options_page')) {
	add_options_page("Social Dropdown", "Social Dropdown", 8, "dropdownconfig", "Dropdown_optionspage");
	}
}


function GenerateAll() {
//Makes it easier to handle the links and images
//Put GenerateLink('separator'); to separate the links into another line

//These will be generated in the dropdown area
GenerateLink('blinkbits');
GenerateLink('blinklist');
GenerateLink('bloglines');
GenerateLink('blogmarks');
GenerateLink('buddymarks');
GenerateLink('citeulike');
GenerateLink('comments');
GenerateLink('delicious');
GenerateLink('digg');
GenerateLink('diigo');
GenerateLink('separator'); //Separator
GenerateLink('fark');
GenerateLink('feedmelinks');
GenerateLink('furl');
GenerateLink('google');
GenerateLink('linkagogo');
GenerateLink('magnolia');
GenerateLink('netvouz');
GenerateLink('newsvine');
GenerateLink('propeller');
GenerateLink('reddit');
GenerateLink('separator'); //Separator
GenerateLink('rawsugar');
GenerateLink('rojo');
GenerateLink('simpy');
GenerateLink('sphinn');
GenerateLink('spurl');
GenerateLink('squidoo');
GenerateLink('stumbleupon');
GenerateLink('tailrank');
GenerateLink('technorati');
GenerateLink('yahoo');
}

function NoJavaGenerateAll() {
//Makes it easier to handle the links and images
//Put GenerateLink('separator'); to separate the links into another line

//This will be generated if the user has no JavaScript - keep it as few as possible
GenerateLink('blinkbits');
GenerateLink('blinklist');
GenerateLink('bloglines');
GenerateLink('blogmarks');
GenerateLink('citeulike');
GenerateLink('comments');
GenerateLink('delicious');
GenerateLink('digg');
GenerateLink('diigo');
GenerateLink('feedmelinks');
GenerateLink('separator'); //Separator
GenerateLink('furl');
GenerateLink('google');
GenerateLink('reddit');
GenerateLink('sphinn');
GenerateLink('spurl');
GenerateLink('squidoo');
GenerateLink('stumbleupon');
GenerateLink('tailrank');
GenerateLink('technorati');
GenerateLink('yahoo');
}

$isfirst = '';

function Show_Dropdown() {
global $isfirst;
?>
<script type="text/javascript">
<!--/*--><![CDATA[/*><!--*/
var menu<?php the_ID(); ?>=new Array()
menu<?php the_ID(); ?>[0]= '<div class="dropcontent"><p>Bookmark this article!</p><p><?php
GenerateAll();
?></p><?php if (get_option('dropdown_allowlinkback') != 'false') { ?><p><small><a rel="external" style="color: #CCCCCC;" href="http://www.tevine.com/projects/socialdropdown" title="Social Dropdown">Social Dropdown</a></small></p><?php } ?></div>';
var droptext = "<p class=\"taskbuttoncontainer\"><span class=\"booktaskbutton\"><a class=\"bookbutton\" id=\"bookbutton<?php the_ID(); ?>\" href=\"javascript:void(0);\" onclick=\"return dropdownmenu(document.getElementById('bookbutton<?php the_ID(); ?>'), event, menu<?php the_ID(); ?>, '300px', document.getElementById('bookdropbutton<?php the_ID(); ?>'))\" onmouseout=\"\" title=\"Bookmarking options\">Bookmark This</a><a class=\"dropdownbutton\" id=\"bookdropbutton<?php the_ID(); ?>\" href=\"javascript:void(0);\" onclick=\"return dropdownmenu(document.getElementById('bookbutton<?php the_ID(); ?>'), event, menu<?php the_ID(); ?>, '300px', document.getElementById('bookdropbutton<?php the_ID(); ?>'))\" onmouseout=\"\" title=\"Bookmarking options\">&nbsp;</a></span> </p>";
document.write(droptext);
/*]]>*/-->
</script>
<div><noscript><div class="nojavadropcontent" style="text-align: center;"><p>Bookmark this article!<?php if (get_option('dropdown_allowlinkback') != 'false') { ?> <span><a style="color: #CCCCCC;"  rel="external<?php if ($isfirst == '' && is_home()) { $isfirst = 'false'; } else { echo ' nofollow'; } ?>" href="http://www.tevine.com/projects/socialdropdown/" title="Get Social Dropdown">[?]</a></span><?php } ?></p><p><?php
NoJavaGenerateAll();
?></p></div></noscript></div>
<?php
}

function GenerateLink($type) {
if ($type != 'separator') {
?><a class="link" rel="external nofollow" title="<?php GenerateName($type); ?>" href="<?php GenerateURL($type) ?>"><img alt="<?php GenerateName($type); ?>" src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/<?php echo $type; ?>.png" /></a><?php
} else {
echo '</p><p>';
}
}

function GenerateName($type) {
//Helps allocate a proper name for the social bookmarking site
switch ($type) {
case 'blinkbits':
echo 'Blinkbits';
break;
case 'blinklist':
echo 'BlinkLists';
break;
case 'bloglines':
echo 'BlogLines';
break;
case 'blogmarks':
echo 'Blogmarks';
break;
case 'buddymarks':
echo 'Buddymarks';
break;
case 'citeulike':
echo 'CiteULike';
break;
case 'comments':
echo 'Co.mments';
break;
case 'delicious':
echo 'Del.icio.us';
break;
case 'digg':
echo 'Digg';
break;
case 'diigo':
echo 'Diigo';
break;
case 'feedmelinks':
echo 'Feed Me Links';
break;
case 'fark':
echo 'Fark';
break;
case 'furl':
echo 'Furl';
break;
case 'google':
echo 'Google';
break;
case 'linkagogo':
echo 'Linkagogo';
break;
case 'magnolia':
echo 'ma.gnolia';
break;
case 'netvouz':
echo 'Netvouz';
break;
case 'newsvine':
echo 'Newsvine';
break;
case 'propeller':
echo 'Propeller';
break;
case 'reddit':
echo 'Reddit';
break;
case 'simpy':
echo 'Simpy';
break;
case 'sphinn':
echo 'Sphinn';
break;
case 'spurl':
echo 'Spurl';
break;
case 'squidoo':
echo 'Squidoo';
break;
case 'stumbleupon':
echo 'StumbleUpon';
break;
case 'tailrank':
echo 'Tailrank';
break;
case 'technorati':
echo 'Technorati';
break;
case 'rojo':
echo 'Rojo';
break;
case 'rawsugar':
echo 'Rawsugar';
break;
case 'yahoo':
echo 'Yahoo';
break;
default:
echo ucfirst($type);
break;

}
}

function GenerateURL($type) {
$socialuri = '';
switch ($type) {
case 'blinkbits':
echo htmlentities('http://www.blinkbits.com/bookmarklets/save.php?v=1&source_url='.get_permalink().'&Title='.get_the_title());
break;
case 'blinklist':
echo htmlentities('http://www.blinklist.com/index.php?Action=Blink/addblink.php&Url='.get_permalink().'&Title='.get_the_title());
break;
case 'bloglines':
echo htmlentities('http://www.bloglines.com/sub/'.get_permalink());
break;
case 'blogmarks':
echo htmlentities('http://www.blogmarks.net/my/new.php?mini=1&title='.get_the_title().'&url='.get_permalink());
break;
case 'buddymarks':
echo htmlentities('http://www.buddymarks.com/add_bookmark.php?bookmark_title='.get_the_title().'&bookmark_url='.get_permalink());
break;
case 'comments':
echo htmlentities('http://co.mments.com/track?url='.get_permalink());
break;
case 'citeulike':
echo htmlentities('http://www.citeulike.org/posturl?url='.get_permalink().'&title='.get_the_title());
break;
case 'delicious':
echo htmlentities('http://del.icio.us/post?url='.get_permalink().'&title='.get_the_title());
break;
case 'digg':
echo htmlentities('http://www.digg.com/submit?phase=2&url='.get_permalink().'&title='.get_the_title());
break;
case 'diigo':
echo htmlentities('http://www.diigo.com/post?url='.get_permalink().'&title='.get_the_title());
break;
case 'feedmelinks':
echo htmlentities('http://www.feedmelinks.com/categorize?from=toolbar&op=submit&name='.get_the_title().'&url='.get_permalink());
break;
case 'fark':
echo htmlentities(' http://cgi.fark.com/cgi/fark/edit.pl?new_url='.get_permalink().'&new_comment='.get_the_title());
break;
case 'furl':
echo htmlentities('http://www.furl.net/storeIt.jsp?t='.get_the_title().'&u='.get_permalink());
break;
case 'google':
echo htmlentities('http://www.google.com/bookmarks/mark?op=edit&bkmk='.get_permalink().'&title='.get_the_title());
break;
case 'listable':
echo htmlentities('http://www.google.com/bookmarks/mark?op=edit&bkmk='.get_permalink().'&title='.get_the_title());
break;
case 'netvouz':
echo htmlentities('http://www.netvouz.com/action/submitBookmark?url='.get_permalink().'&title='.get_the_title().'&popup=no');
break;
case 'newsvine':
echo htmlentities('http://www.newsvine.com/_wine/save?popoff=0&u='.get_permalink().'&h='.get_the_title());
break;
case 'reddit':
echo htmlentities('http://www.reddit.com/submit?url='.get_permalink().'&title='.get_the_title());
break;
case 'linkagogo':
echo htmlentities('http://www.linkagogo.com/go/AddNoPopup?title='.get_the_title().'&url='.get_permalink());
break;
case 'magnolia':
echo htmlentities('http://ma.gnolia.com/bookmarklet/add?url='.get_permalink().'&title='.get_the_title());
break;
case 'propeller':
echo htmlentities('http://www.propeller.com/submit/?U='.get_permalink().'&T='.get_the_title().'C=');
break;
case 'simpy':
echo htmlentities('http://www.simpy.com/simpy/LinkAdd.do?note='.get_the_title().'&href='.get_permalink());
break;
case 'sphinn':
echo htmlentities('http://www.sphinn.com/submit.php?url='.get_permalink().'&title='.get_the_title());
break;
case 'spurl':
echo htmlentities('http://www.spurl.net/spurl.php?url='.get_permalink().'&title='.get_the_title());
break;
case 'squidoo':
echo htmlentities('http://www.squidoo.com/lensmaster/bookmark?'.get_permalink());
break;
case 'stumbleupon':
echo htmlentities('http://www.stumbleupon.com/submit?url='.get_permalink().'&title='.get_the_title());
break;
case 'tailrank':
echo htmlentities('http://www.tailrank.com/share/?title='.get_the_title().'&link_href='.get_permalink());
break;
case 'technorati':
echo htmlentities('http://www.technorati.com/faves?add='.get_permalink());
break;
case 'rawsugar':
echo htmlentities('http://www.rawsugar.com/pages/tagger.faces?turl='.get_permalink().'&tttl='.get_the_title());
break;
case 'rojo':
echo htmlentities('http://www.rojo.com/add-subscription/?resource='.get_permalink());
break;
case 'yahoo':
echo htmlentities('http://myweb2.search.yahoo.com/myresults/bookmarklet?t='.get_the_title().'&u='.get_permalink());
break;
}

}


//Runs the plugin
add_action('wp_head', 'Dropdown_header');
add_action('admin_menu', 'Dropdown_options');

?>