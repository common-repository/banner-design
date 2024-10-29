<?php
/*
	Plugin Name: Banner Design
	Plugin URI: http://www.hotwordpressplugins.com
	Description: Banner Design. Load your images(jpg, gif, png) in: wp-content/plugins/banner-design/images/. For create and configure the galleries press in your Wordpress admin: Settings->Banner Design.
	Version: 1.1
	Author: hotwordpressplugins
	Author URI: http://www.hotwordpressplugins.com
*/	
$contador=0;
function banner_design_head() {
	
	$site_url = get_option( 'siteurl' );			
			echo '<script src="'.$site_url.'/wp-content/plugins/banner-design/Scripts/swfobject_modified.js" type="text/javascript"></script>';
			
}
function banner_design($content){
	$content = preg_replace_callback("/\[banner_design ([^]]*)\/\]/i", "banner_design_render", $content);
	return $content;
	
}

function banner_design_render($tag_string){
$contador=rand(9, 9999999);
	$site_url = get_option( 'siteurl' );
global $wpdb; 	
$table_name = $wpdb->prefix . "banner_design";	


if(isset($tag_string[1])) {
	$auxi1=str_replace(" ", "", $tag_string[1]);
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );
}
if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	$conta=0;
	$id= $myrows[$conta]->id;
	$folder = $myrows[$conta]->folder;
	$timeback = $myrows[$conta]->timeback;
	$onover = $myrows[$conta]->onover;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$links = $myrows[$conta]->links;
	$title = $myrows[$conta]->title;
	$tit = $myrows[$conta]->tit;
	$target = $myrows[$conta]->target;
	
	$music = $myrows[$conta]->music;
	$controls = $myrows[$conta]->controls;
	$typee = $myrows[$conta]->type;
	$columns = $myrows[$conta]->columns;
	$rows = $myrows[$conta]->rows;
	$speed = $myrows[$conta]->speed;
	$speed2 = $myrows[$conta]->speed2;
	$color1 = $myrows[$conta]->color1;
	$color3 = $myrows[$conta]->color3;
	$background = $myrows[$conta]->background;
	$round2 = $myrows[$conta]->round2;
	$bordercolor = $myrows[$conta]->bordercolor;
	$text7 = $myrows[$conta]->text7;
	$text1 = $myrows[$conta]->text1;
	$text2 = $myrows[$conta]->text2;
	$text3 = $myrows[$conta]->text3;
	$text4 = $myrows[$conta]->text4;
	$text5 = $myrows[$conta]->text5;
	$text6 = $myrows[$conta]->text6;
	$escala = $myrows[$conta]->escala;
	$round1 = $myrows[$conta]->round1;
	$border1 = $myrows[$conta]->border1;


		$type 		= 'png';
		$type1 		= 'jpg';
		$type2 		= 'gif';
		
		$files	= array();
		$images	= array();

		$dir = $folder;

		// check if directory exists
		if (is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..' && $file != 'CVS' && $file != 'index.html' ) {
						$files[] = $file;
					}
				}
			}
			closedir($handle);

			$i = 0;
			foreach ($files as $img)
			{
				if (!is_dir($dir .DS. $img))
				{
					if (eregi($type, $img) || eregi($type1, $img)|| eregi($type2, $img)) {
						$images[$i]->name 	= $img;
						$images[$i]->folder	= $folder;
						++$i;
					}
				}
			}
			$cantidad=$i;
		}
		else $cantidad=0;


	$texto='';
	
	
	
	
	$texto='cantidad='.$cantidad.'&orientacion='.'&carpeta='.$folder.'&escala='.$onover.'&link='.$links.'&timeback='.$timeback.'&music='.$music.'&controls='.$controls.'&type='.$typee.'&columns='.$columns.'&rows='.$rows.'&speed='.$speed.'&speed2='.$speed2.'&color1='.$color1.'&color3='.$color3.'&color2='.$color3.'&background='.$background.'&round2='.$round2.'&bordercolor='.$bordercolor.'&text7='.$text7.'&text1='.$text1.'&text2='.$text2.'&text3='.$text3.'&text4='.$text4.'&text5='.$text5.'&text6='.$text6.'&border='.$border1.'&round='.$round1.'&target='.$target;
	
	
	$imagesc=split("\n", $links);
	$titles=split("\n", $title);
	$conta=0;

	sort($images);
			foreach ($images as $img)
			{
						$auxilink="";
						$auxilink2="";

					if(isset($imagesc[$conta])) $auxilink=$imagesc[$conta];
					if(isset($titles[$conta])) $auxilink2=$titles[$conta];
					
					$texto.='&imagen'.$conta.'='.$site_url.'/'.$folder.''.$img->name;
					$texto.='&link'.$conta.'='.$auxilink;
					$texto.='&title'.$conta.'='.$auxilink2;
				
					$conta++;

			}
	
	
	$table_name = $wpdb->prefix . "banner_design";
	$saludo= $wpdb->get_var("SELECT id FROM $table_name ORDER BY RAND() LIMIT 0, 1; " );


	$output='
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$width.'" height="'.$height.'" id="Gallery'.$id.'-'.$contador.'" title="'.$tit.'">
  <param name="movie" value="'.$site_url.'/wp-content/plugins/banner-design/banner_design.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
   <param name="scale" value="exactfit" />
  	<param name="flashvars" value="'.$texto.'" />
  <param name="swfversion" value="9.0.45.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="'.$site_url.'/wp-content/plugins/banner-design/Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="'.$site_url.'/wp-content/plugins/banner-design/banner_design.swf" width="'.$width.'" height="'.$height.'">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
	  <param name="scale" value="exactfit" />
    	<param name="flashvars" value="'.$texto.'" />
    <param name="swfversion" value="9.0.45.0" />
    <param name="expressinstall" value="'.$site_url.'/wp-content/plugins/banner-design/Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
<!--
swfobject.registerObject("Gallery'.$id.'-'.$contador.'");
//-->
</script>
';

	return $output;
}
function banner_design_instala(){
	global $wpdb; 
	$table_name= $wpdb->prefix . "banner_design";
   $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		folder tinytext NOT NULL ,
		timeback tinytext NOT NULL ,
		onover tinytext NOT NULL ,
		links tinytext NOT NULL ,
		width tinytext NOT NULL ,
		height tinytext NOT NULL ,
		title tinytext NOT NULL ,
		tit tinytext NOT NULL ,
		target tinytext NOT NULL ,
		music tinytext NOT NULL ,
		controls tinytext NOT NULL ,
		type tinytext NOT NULL ,
		columns tinytext NOT NULL ,
		rows tinytext NOT NULL ,
		speed tinytext NOT NULL ,
		speed2 tinytext NOT NULL ,
		color1 tinytext NOT NULL ,
		color3 tinytext NOT NULL ,
		background tinytext NOT NULL ,
		round2 tinytext NOT NULL ,
		bordercolor tinytext NOT NULL ,
		text7 tinytext NOT NULL ,
		text1 tinytext NOT NULL ,
		text2 tinytext NOT NULL ,
		text3 tinytext NOT NULL ,
		text4 tinytext NOT NULL ,
		text5 tinytext NOT NULL ,
		text6 tinytext NOT NULL ,
		escala tinytext NOT NULL ,
		border1 tinytext NOT NULL ,
		round1 tinytext NOT NULL ,
		PRIMARY KEY ( `id` )	
	) ;";
	$wpdb->query($sql);
$sql = "INSERT INTO $table_name (folder, timeback,  onover, links, width, height, title, tit, target, music, controls, type, columns, rows, speed, speed2, color1, color3, background, round2, bordercolor, text7, text1, text2, text3, text4, text5, text6, escala, border1, round1) VALUES ('wp-content/plugins/banner-design/images/', '5', '1', 'http://www.hotwordpressplugins.com', '100%', '250px', 'Banner Design Plugin', '', '', '', '1', '1', '6', '4', '32', '3',  'ffffff', '000000', '', '8', 'ffffff', '0', '24', 'color', 'left', '0', '0', '0', '1', '0', '0');";
	$wpdb->query($sql);
}
function banner_design_desinstala(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "banner_design";
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);
}	
function banner_design_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "banner_design";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
//autos  no existe
if(empty($re))
{
  $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		folder tinytext NOT NULL ,
		timeback tinytext NOT NULL ,
		onover tinytext NOT NULL ,
		links tinytext NOT NULL ,
		width tinytext NOT NULL ,
		height tinytext NOT NULL ,
		title tinytext NOT NULL ,
		tit tinytext NOT NULL ,
		target tinytext NOT NULL ,
		music tinytext NOT NULL ,
		controls tinytext NOT NULL ,
		type tinytext NOT NULL ,
		columns tinytext NOT NULL ,
		rows tinytext NOT NULL ,
		speed tinytext NOT NULL ,
		speed2 tinytext NOT NULL ,
		color1 tinytext NOT NULL ,
		color3 tinytext NOT NULL ,
		background tinytext NOT NULL ,
		round2 tinytext NOT NULL ,
		bordercolor tinytext NOT NULL ,
		text7 tinytext NOT NULL ,
		text1 tinytext NOT NULL ,
		text2 tinytext NOT NULL ,
		text3 tinytext NOT NULL ,
		text4 tinytext NOT NULL ,
		text5 tinytext NOT NULL ,
		text6 tinytext NOT NULL ,
		escala tinytext NOT NULL ,
		border1 tinytext NOT NULL ,
		round1 tinytext NOT NULL ,
		PRIMARY KEY ( `id` )
	) ;";
	$wpdb->query($sql);

}
		
			$sql = "INSERT INTO $table_name (folder, timeback,  onover, links, width, height, title, tit, target, music, controls, type, columns, rows, speed, speed2, color1, color3, background, round2, bordercolor, text7, text1, text2, text3, text4, text5, text6, escala, border1, round1) VALUES ('wp-content/plugins/banner-design/images/', '5', '1', 'http://www.hotwordpressplugins.com', '100%', '250px', 'Banner Design Plugin', '', '', '', '1', '1', '6', '4', '32', '3',  'ffffff', '000000', '', '8', 'ffffff', '0', '24', 'color', 'left', '0', '0', '0', '1', '0', '0');";
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	
	
			$sql= "UPDATE $table_name SET `folder` = '".$_POST["folder".$_POST['id']]."', `timeback` = '".$_POST["timeback".$_POST['id']]."', `links` = '".$_POST["links".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `title` = '".$_POST["title".$_POST['id']]."', `music` = '".$_POST["music".$_POST['id']]."', `controls` = '".$_POST["controls".$_POST['id']]."', `type` = '".$_POST["type".$_POST['id']]."', `columns` = '".$_POST["columns".$_POST['id']]."', `rows` = '".$_POST["rows".$_POST['id']]."', `speed` = '".$_POST["speed".$_POST['id']]."', `speed2` = '".$_POST["speed2".$_POST['id']]."', `color1` = '".$_POST["color1".$_POST['id']]."', `color3` = '".$_POST["color3".$_POST['id']]."', `round2` = '".$_POST["round2".$_POST['id']]."', `text7` = '".$_POST["text7".$_POST['id']]."', `text1` = '".$_POST["text1".$_POST['id']]."', `text2` = '".$_POST["text2".$_POST['id']]."', `text3` = '".$_POST["text3".$_POST['id']]."', `text4` = '".$_POST["text4".$_POST['id']]."', `text5` = '".$_POST["text5".$_POST['id']]."', `text6` = '".$_POST["text6".$_POST['id']]."', `escala` = '".$_POST["escala".$_POST['id']]."', `border1` = '".$_POST["border1".$_POST['id']]."', `round1` = '".$_POST["round1".$_POST['id']]."', `tit` = '".$_POST["tit".$_POST['id']]."', `target` = '".$_POST["target".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
			
			
			
			
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;

include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$folder = $myrows[$conta]->folder;
	$timeback = $myrows[$conta]->timeback;
	$onover = $myrows[$conta]->onover;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$links = $myrows[$conta]->links;
	$title = $myrows[$conta]->title;
	$tit = $myrows[$conta]->tit;
	$target = $myrows[$conta]->target;
	$music = $myrows[$conta]->music;
	$controls = $myrows[$conta]->controls;
	$type = $myrows[$conta]->type;
	$columns = $myrows[$conta]->columns;
	$rows = $myrows[$conta]->rows;
	$speed = $myrows[$conta]->speed;
	$speed2 = $myrows[$conta]->speed2;
	$color1 = $myrows[$conta]->color1;
	$color3 = $myrows[$conta]->color3;
	$background = $myrows[$conta]->background;
	$round2 = $myrows[$conta]->round2;
	$bordercolor = $myrows[$conta]->bordercolor;
	$text7 = $myrows[$conta]->text7;
	$text1 = $myrows[$conta]->text1;
	$text2 = $myrows[$conta]->text2;
	$text3 = $myrows[$conta]->text3;
	$text4 = $myrows[$conta]->text4;
	$text5 = $myrows[$conta]->text5;
	$text6 = $myrows[$conta]->text6;
	$escala = $myrows[$conta]->escala;
	$round1 = $myrows[$conta]->round1;
	$border1 = $myrows[$conta]->border1;

	
	include('template/panel.html');			
	$conta++;
	}

}
function banner_design_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		add_options_page('banner_design', 'Banner Design', 8, basename(__FILE__), 'banner_design_panel');
	}
}
if (function_exists('add_action')) {
	add_action('admin_menu', 'banner_design_add_menu'); 
}
add_action('wp_head', 'banner_design_head');
add_filter('the_content', 'banner_design');
add_action('activate_banner_design/banner_design.php','banner_design_instala');
add_action('deactivate_banner_design/banner_design.php', 'banner_design_desinstala');
?>