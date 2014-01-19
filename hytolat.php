<?php
/*
Plugin Name: HyToLat
Plugin URI: http://wordpress.org/plugins/hytolat/
Description: Converts Armenian characters in post,page and term links to Latin characters. Very useful for Armenian-speaking users of WordPress. You can use this plugin for creating human-readable links. Send your suggestions and critics to <a href="mailto:daviderevan@yandex.ru">daviderevan@yandex.ru</a>.
Author: David Davtyan <daviderevan@yandex.ru>
Author URI: http://aboutgadget.ru
Version: 0.1
*/ 
  
$hyChar = array(
"և"=>"ev","ու"=>"u","[\s\t]+?ո"=>"\svo",
"Ա"=>"A","Բ"=>"B","Գ"=>"G","Դ"=>"D","Ե"=>"Ye","Զ"=>"Z","Է"=>"E",
"Ը"=>"Eh","Թ"=>"Th","Ժ"=>"Zh","Ի"=>"I","Լ"=>"L","Խ"=>"X","Ծ"=>"Tc",
"Կ"=>"K","Հ"=>"H","Ձ"=>"Dz","Ղ"=>"Gh","Ճ"=>"Tch","Մ"=>"M","Յ"=>"Y",
"Ն"=>"N","Շ"=>"Sh","Ո"=>"Vo","Չ"=>"Ch","Պ"=>"P","Ջ"=>"J","Ռ"=>"R",
"Ս"=>"S","Վ"=>"V","Տ"=>"T","Ր"=>"R","Ց"=>"C","Փ"=>"Ph","Ք"=>"Kh",
"Օ"=>"O","Ֆ"=>"F",
"ա"=>"a","բ"=>"b","գ"=>"g","դ"=>"d","ե"=>"e","զ"=>"z","է"=>"e",
"ը"=>"eh","թ"=>"th","ժ"=>"zh","ի"=>"i","լ"=>"l","խ"=>"x","ծ"=>"tc",
"կ"=>"k","հ"=>"h","ձ"=>"dz","ղ"=>"gh","ճ"=>"tch","մ"=>"m","յ"=>"y",
"ն"=>"n","շ"=>"sh","ո"=>"o","չ"=>"ch","պ"=>"p","ջ"=>"j","ռ"=>"r",
"ս"=>"s","վ"=>"v","տ"=>"t","ր"=>"r","ց"=>"c","փ"=>"ph","ք"=>"kh",
"օ"=>"o","ֆ"=>"f",
"№"=>"#","—"=>"-","«"=>"","»"=>"","…"=>""
  );
 
function hy_to_translit($title) {
	global $hyChar;
	$htl_standard = get_option('htl_standard');
	switch ($htl_standard) {
		case 'off':
		    return $title;		
		default: 
		    return strtr($title, $hyChar);
	}
}

function htl_options_page() {
?>
<div class="wrap">
	<h2>Настройки HyToLat</h2>
	<p>Вы можете включить/выключить плагин. Со следующей версией будут доступны и другие настройки)</p>
	<?php
	if($_POST['htl_standard']) {
		// set the post formatting options
		update_option('htl_standard', $_POST['htl_standard']);
		echo '<div class="updated"><p>Настройки обновлены.</p></div>';
	}
	?>

	<form method="post">
	<fieldset class="options">
		<legend>Выключатель:</legend>
		<?php
		$htl_standard = get_option('htl_standard');
		?>
			<select name="htl_standard">
				<option value="off"<?php if($htl_standard == 'off'){ echo(' selected="selected"');}?>>Отключено</option>
        <option value="iso"<?php if($htl_standard == 'iso' OR $htl_standard == ''){ echo(' selected="selected"');}?>>Включено</option>        								
			</select>

			<input type="submit" value="Сохранить" />

	</fieldset>
	</form>
</div>
<?php
}

function htl_add_menu() {
		add_options_page('HyToLat', 'HyToLat', 8, __FILE__, 'htl_options_page');
}

add_action('admin_menu', 'htl_add_menu');
add_filter('sanitize_title', 'hy_to_translit', 1);
?>
