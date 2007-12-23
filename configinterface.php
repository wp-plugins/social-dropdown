
<script language="JavaScript" src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/ajax.js"></script>
	<script language="JavaScript" src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/thescripts/prototype.js"></script>
	<script language="JavaScript" src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/thescripts/scriptaculous.js"></script>

<?php include_once('generatebookmarks.php'); ?>

	<script language="JavaScript">
	//sections = ['group1','group2','group3', 'group4'];
	sections = [<?php GetBookmarkSections(); ?>];

	function createNewSection(name) {
		var name = $F('sectionName');
name = ' ';
		if (name != '') {
			var newDiv = Builder.node('div', {id: 'group' + (sections.length + 1), className: 'section', style: 'display:none;' }, [
				Builder.node('h3', {className: 'handle'}, name)
			]);

			sections.push(newDiv.id);
			$('page').appendChild(newDiv);
			Effect.Appear(newDiv.id);
			destroyLineItemSortables();
			createLineItemSortables();
			createGroupSortable();
		}
	}

	function createLineItemSortables() {
		for(var i = 0; i < sections.length; i++) {
			Sortable.create(sections[i],{tag:'div',dropOnEmpty: true, containment: sections,only:'lineitem', overlap: 'horizontal',constraint:false,onChange:function(){pushinfo()}});
		}
	}

	function destroyLineItemSortables() {
		for(var i = 0; i < sections.length; i++) {
			Sortable.destroy(sections[i]);
		}
	}

	function createGroupSortable() {
		Sortable.create('page',{tag:'div',only:'section',handle:'handle',onChange:function(){pushinfo()}});
	}

	/*
	Debug Functions for checking the group and item order
	*/
	function getGroupOrder() {
		var sections = document.getElementsByClassName('section');
		var alerttext = '';
		sections.each(function(section) {
			var sectionID = section.id;
			var order = Sortable.serialize(sectionID);
			alerttext += sectionID + ': ' + Sortable.sequence(section) + '\n';
		});
		alert(alerttext);
		return false;
	}

	function pushinfo() {
		textinfo = document.getElementById('dropdown_query');
		var sectarray = GroupsArray();
//alert(sectarray.length);
		textinfo.value = '';
		for (var c = 0; c < sectarray.length; c++) {
//alert(sectarray.length+'oke'+c);
//if (sectarray[c] != 'group4') {
//omits unwanted group
		listitemparent = document.getElementById(sectarray[c]);

if (listitemparent != null) {
//alert('ok');
		var items = listitemparent.getElementsByTagName("div");

if (c == 0) {
				textinfo.value = textinfo.value;
				} else {
				textinfo.value = textinfo.value + ","; //separates the items
				}

		var array = new Array()

			for (var i = 0, n = items.length; i < n; i++) {
				var item = items[i]
				if (i == 0) {
				textinfo.value = textinfo.value + item.id;
				} else {
				textinfo.value = textinfo.value + "|" + item.id;
				}

			}
//}
}
		}
UpdatePreview()
	}

function GroupsArray() {
		var sections = document.getElementsByClassName('section');
		var alerttext = '';
		sections.each(function(section) {
			var sectionID = section.id;
			var order = Sortable.serialize(sectionID);
			alerttext += sectionID + ':';
		});
		return alerttext.split(':');
}
function ShowGroupsArray() {
		var sections = document.getElementsByClassName('section');
		var alerttext = '';
		sections.each(function(section) {
			var sectionID = section.id;
			var order = Sortable.serialize(sectionID);
			alerttext += sectionID + '|';
		});
		alert(alerttext);
}

function UpdatePreview() {
textinfo = document.getElementById('dropdown_query');
CallAJAX(textinfo.value, '<?php bloginfo('url'); ?>');
}





	</script>

<style>
	.configwidget div {
		font-family: Arial, Helvetica;
		font-size: 11px;
	}

	.configwidget div.section {
		border: 1px solid #CCCCCC;
		margin: 20px 5px;
		padding: 0px 0px 5px 0px;
		background-color: #EEEEEE;
		height: 65px;
	}
	.configwidget div#createNew {
		border: 1px solid #B9CDE5;/*#95B3D7*/
		margin: 30px 5px;
		padding: 0px 0px 10px 0px;
		background-color: #DCE6F2;/*#B9CDE5*/
	}
	.configwidget div#createNew h3{
		font-size: 14px;
		padding: 2px 5px;
		margin: 0 0 10px 0;
		background-color: #B9CDE5;
		color: #FFFFFF;
		display: block;
	}

	.configwidget div.toolsection {
		border: 1px solid #CDEB8B;
		margin: 30px 5px;
		padding: 0px 0px 10px 0px;
		background-color: #DFF2B5;
		height: 110px;
	}	
	.configwidget div.toolsection h3{
		font-size: 14px;
		padding: 2px 5px;
		margin: 0 0 10px 0;
		background-color: #CDEB8B;
		color: #FFFFFF;
		display: block;
	}
.configwidget .previewcontainer {
text-align: center;
}
.configwidget .displaypreview {
text-align: center;
height: 140px;
overflow: auto;
/*width: 400px;*/
/*border: 1px solid #EEEEEE;*/
}
.configwidget .displaypreview p {
margin: 10px;
padding: 0px;
}
.configwidget .displaypreview img {
width: 16px;
height: 16px;
margin: 2px;
vertical-align: middle;
}

	.configwidget div#createNew input { margin-left: 5px; }

	.configwidget div.section h3{
		font-size: 14px;
		padding: 2px 5px;
		margin: 0 0 5px 0;
		background-color: #CCCCCC;
		display: block;
	}

	.configwidget div.section h3 {
		cursor: move;
	}

	.configwidget div.lineitem {
		margin: 3px 10px;
		padding: 2px;
		background-color: #FFFFFF;
		border: 1px solid #DDDDDD;
		cursor: move;
		display: block;
		width: 100px;
		position: relative;
		float: left;
		vertical-align: middle;
		height: 16px;
	}
	.configwidget div.lineitem p {
		float: none;
		margin: 0px;
		padding: 0px;
	}
	.configwidget div.lineitem img {
		vertical-align: middle;
		margin-right: 5px;
		width: 16px;
		height: 16px;
	}

	.configwidget h1 {
		margin-bottom: 0;
		font-size: 18px;
	}
	.configwidget hr {
	border: 1px solid #EEEEEE;
	height: 1px;
	}
</style>

<div class="configwidget">
<?php global $overrideoptions; if ($overrideoptions != 'true') { ?>
	<div id="createNew">
		<h3>Information</h3>
		<p style="margin: 5px; padding: 0px; font-size: 14px;">Drag and drop the social bookmarks into the grey boxes for them to be included. Drag bookmarks into the green box (Unused social bookmarks) for them to be not included.</p>
<p style="margin: 5px; padding: 0px; font-size: 14px;">You can organise bookmarks into rows by dragging them into the separate grey boxes. You can add new rows by clicking on the '<strong>Add new row</strong>' button. Rows can be rearranged by simply dragging the top handle of the grey box. Empty rows will be ignored when generating the bookmarks.</p>
<p style="margin: 5px; padding: 0px; font-size: 14px;">Note: It is advisible not to put more than 10 bookmarks per row.</p>
<p style="margin: 15px 5px 5px 5px; padding: 0px; font-size: 14px;">Once done customizing your bookmarks, click on the '<strong>Update Options &raquo;</strong>' button to save your changes.</p>

<p style="margin: 5px; padding: 0px; font-size: 14px;">
		<input type="hidden" id="sectionName" size="25">
		<input type="button" onClick="createNewSection();" value="Add new row"> <!--<input type="button" onClick="pushinfo();" value="Info"><input type="button" onClick="ShowGroupsArray();" value="Group Alignment">--><input type="hidden" id="dropdown_query" name="dropdown_query" value="<?php echo get_option('dropdown_allowlinkback'); ?>" />
		</p>
	</div>
<noscript>Social bookmark generator requires JavaScript to run</noscript>
<hr />
<div name="preview" id="preview" class="previewcontainer">
Preview<br />
<div class="displaypreview" id="dispprev"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/loading.png" /> Preview coming up...</div>
<hr />
</div>
<?php CreateConfigBookmarks(); ?>
<?php /* ?>
<div id="page">

	<div id="group1" class="section">
		<h3 class="handle"> </h3>
		<div id="blinkbits" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/blinkbits.png" />BlinkBits</p></div>
		<div id="blinklist" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/blinklist.png" />BlinkList</p></div>
		<div id="bloglines" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/bloglines.png" />BlogLines</p></div>
		<div id="blogmarks" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/blogmarks.png" />BlogMarks</p></div>
		<div id="buddymarks" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/buddymarks.png" />BuddyMarks</p></div>
		<div id="citeulike" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/citeulike.png" />CiteULike</p></div>
		<div id="comments" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/comments.png" />Co.mments</p></div>
		<div id="delicious" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/delicious.png" />Del.icio.us</p></div>
		<div id="digg" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/digg.png" />Digg</p></div>
		<div id="diigo" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/diigo.png" />Diigo</p></div>
	</div>

	<div id="group2" class="section">
		<h3 class="handle"> </h3>
		<div id="fark" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/fark.png" />Fark</p></div>
		<div id="feedmelinks" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/feedmelinks.png" />Feed Me Links</p></div>
		<div id="furl" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/furl.png" />Furl</p></div>
		<div id="google" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/google.png" />Google</p></div>
		<div id="linkagogo" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/linkagogo.png" />Linkagogo</p></div>
		<div id="magnolia" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/magnolia.png" />Ma.gnolia</p></div>
		<div id="netvouz" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/netvouz.png" />Netvouz</p></div>
		<div id="newsvine" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/newsvine.png" />Newsvine</p></div>
		<div id="propeller" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/propeller.png" />Propeller</p></div>
		<div id="rawsugar" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/rawsugar.png" />Raw Sugar</p></div>
	</div>

	<div id="group3" class="section">
		<h3 class="handle"> </h3>
		<div id="reddit" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/reddit.png" />Reddit</p></div>
		<div id="rojo" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/rojo.png" />Rojo</p></div>
		<div id="simpy" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/simpy.png" />Simpy</p></div>
		<div id="sphinn" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/sphinn.png" />Sphinn</p></div>
		<div id="spurl" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/spurl.png" />Spurl</p></div>
		<div id="squidoo" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/squidoo.png" />Squidoo</p></div>
		<div id="stumbleupon" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/stumbleupon.png" />StumbleUpon</p></div>
		<div id="tailrank" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/tailrank.png" />TailRank</p></div>
		<div id="technorati" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/technorati.png" />Technorati</p></div>
		<div id="yahoo" class="lineitem"><p><img src="<?php bloginfo('url'); ?>/wp-content/plugins/socialdropdown/icons/yahoo.png" />Yahoo MyWeb</p></div>
	</div>



</div>
<hr />
	<div id="group4" class="toolsection">
		<h3 class="handle">Unused social bookmarks</h3>
<!--
		<div id="item_1" class="lineitem">Mr Wong</div>
		<div id="item_2" class="lineitem">Web News</div>
		<div id="item_3" class="lineitem">Icio</div>
		<div id="item_4" class="lineitem">OneView</div>
		<div id="item_5" class="lineitem">LinkArena</div>
		<div id="item_6" class="lineitem">Newskick</div>
		<div id="item_7" class="lineitem">Seekxl</div>
		<div id="item_8" class="lineitem">Fav It</div>
		<div id="item_9" class="lineitem">Slash Dot</div>
		<div id="item_10" class="lineitem">Smarking</div>
-->
	</div>

<script type="text/javascript">
	// <![CDATA[
	Sortable.create('group1',{tag:'div',dropOnEmpty: true, overlap: 'horizontal',constraint:false, containment: sections,only:'lineitem',onChange:function(){pushinfo()}});
	Sortable.create('group2',{tag:'div',dropOnEmpty: true, overlap: 'horizontal',constraint:false, containment: sections,only:'lineitem',onChange:function(){pushinfo()}});
	Sortable.create('group3',{tag:'div',dropOnEmpty: true, overlap: 'horizontal',constraint:false, containment: sections, only:'lineitem',onChange:function(){pushinfo()}});
	Sortable.create('group4',{tag:'div',dropOnEmpty: true, overlap: 'horizontal',constraint:false, containment: sections, only:'lineitem',onChange:function(){pushinfo()}});

	Sortable.create('page',{tag:'div',only:'section',handle:'handle',onChange:function(){pushinfo()}});

pushinfo(); //Shows a preview

	// ]]>
 </script>
<?php */ ?>
<?php } else { ?>
	<div id="createNew">
		<h3>Information</h3>
		<p style="margin: 5px; padding: 0px; font-size: 14px;">$overrideoptions (in <code>generatebookmarks.php</code>) is set to <code>TRUE</code>. Please set it to <code>FALSE</code> in order to use the options panel to customize the bookmarks.</p>
	</div>
<?php } ?>
</div>
