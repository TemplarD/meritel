<?php
ini_set('display_errors', 0);
session_start();
if (!$_SESSION['lginin'])
	exit;
include('_mysql.php');
function xml2array($contents, $get_attributes=1, $priority = 'tag') {
    if(!$contents)
		return array();
    if(!function_exists('xml_parser_create'))
        return array();
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if(!$xml_values) return;
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();
    $current = &$xml_array;
    $repeated_tag_index = array();
    foreach($xml_values as $data) {
        unset($attributes,$value);
        extract($data);
        $result = array();
        $attributes_data = array();
        if(isset($value)) {
            if($priority == 'tag')
				$result = $value;
            else
				$result['value'] = $value;
        }
        if(isset($attributes) and $get_attributes)
            foreach($attributes as $attr => $val)
                if($priority == 'tag')
					$attributes_data[$attr] = $val;
                else
					$result['attr'][$attr] = $val;
        if($type == "open") {
            $parent[$level-1] = &$current;
            if(!is_array($current) or (!in_array($tag, array_keys($current)))) {
                $current[$tag] = $result;
                if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                $current = &$current[$tag];
            } else {
                if(isset($current[$tag][0])) {
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    $repeated_tag_index[$tag.'_'.$level]++;
                } else {
                    $current[$tag] = array($current[$tag],$result);
                    $repeated_tag_index[$tag.'_'.$level] = 2;
                    if(isset($current[$tag.'_attr'])) {
                        $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                        unset($current[$tag.'_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
                $current = &$current[$tag][$last_item_index];
            }
        } elseif($type == "complete") {
            if(!isset($current[$tag])) {
                $current[$tag] = $result;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                if($priority == 'tag' and $attributes_data)
					$current[$tag. '_attr'] = $attributes_data;
            } else {
                if(isset($current[$tag][0]) and is_array($current[$tag])) {
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    if($priority == 'tag' and $get_attributes and $attributes_data)
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                    $repeated_tag_index[$tag.'_'.$level]++;
                }else{
                    $current[$tag] = array($current[$tag],$result);
                    $repeated_tag_index[$tag.'_'.$level] = 1;
                    if($priority == 'tag' and $get_attributes) {
                        if(isset($current[$tag.'_attr'])) {
                            $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                            unset($current[$tag.'_attr']);
                        }
                        if($attributes_data)
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag.'_'.$level]++;
                }
            }
        }elseif($type == 'close')
            $current = &$parent[$level-1];
    }
    return($xml_array);
}
function lookupcat($ar, $l){
	if(isset($ar['Группа']) && isset($ar['Группа']['Ид'])){
		$url_id_r = mysql_query("SELECT target_id FROM viz213_urls WHERE url='".$ar['Группа']['Ид']['value']."' AND target_type='categories'");
		if($url_id_r && mysql_num_rows($url_id_r)==1)
			$last = mysql_result($url_id_r, 0);
		else{
			mysql_query("INSERT INTO viz213_categories (p_id, id_id, name, shows) VALUES ('".$l."', '".$ar['Группа']['Ид']['value']."', '".$ar['Группа']['Наименование']['value']."', '1')");
			$last = mysql_result(mysql_query("SELECT id FROM viz213_categories ORDER BY id DESC LIMIT 0, 1"), 0);
			mysql_query("INSERT INTO viz213_urls (url, target_id, target_type) VALUES ('".$ar['Группа']['Ид']['value']."', '".$last."', 'categories')");
		}
		if(isset($ar['Группа']['Группы']))
			lookupcat($ar['Группа']['Группы'], $last);
	}else
		foreach($ar['Группа'] AS $gar){
			$url_id_r = mysql_query("SELECT target_id FROM viz213_urls WHERE url='".$gar['Ид']['value']."' AND target_type='categories'");
			if($url_id_r && mysql_num_rows($url_id_r)==1)
				$last = mysql_result($url_id_r, 0);
			else{
				mysql_query("INSERT INTO viz213_categories (p_id, id_id, name, shows) VALUES ('".$l."', '".$gar['Ид']['value']."', '".$gar['Наименование']['value']."', '1')");
				$last = mysql_result(mysql_query("SELECT id FROM viz213_categories ORDER BY id DESC LIMIT 0, 1"), 0);
				mysql_query("INSERT INTO viz213_urls (url, target_id, target_type) VALUES ('".$gar['Ид']['value']."', '".$last."', 'categories')");
			}
			if(isset($gar['Группы']))
				lookupcat($gar['Группы'], $last);
		}
}
function json_fix_cyr($json_str) {
	$cyr_chars = array('\u0430' => 'а', '\u0410' => 'А', '\u0431' => 'б', '\u0411' => 'Б', '\u0432' => 'в', '\u0412' => 'В', '\u0433' => 'г', '\u0413' => 'Г', '\u0434' => 'д', '\u0414' => 'Д', '\u0435' => 'е', '\u0415' => 'Е', '\u0451' => 'ё', '\u0401' => 'Ё', '\u0436' => 'ж', '\u0416' => 'Ж', '\u0437' => 'з', '\u0417' => 'З', '\u0438' => 'и', '\u0418' => 'И', '\u0439' => 'й', '\u0419' => 'Й', '\u043a' => 'к', '\u041a' => 'К', '\u043b' => 'л', '\u041b' => 'Л', '\u043c' => 'м', '\u041c' => 'М', '\u043d' => 'н', '\u041d' => 'Н', '\u043e' => 'о', '\u041e' => 'О', '\u043f' => 'п', '\u041f' => 'П', '\u0440' => 'р', '\u0420' => 'Р', '\u0441' => 'с', '\u0421' => 'С', '\u0442' => 'т', '\u0422' => 'Т', '\u0443' => 'у', '\u0423' => 'У', '\u0444' => 'ф', '\u0424' => 'Ф', '\u0445' => 'х', '\u0425' => 'Х', '\u0446' => 'ц', '\u0426' => 'Ц', '\u0447' => 'ч', '\u0427' => 'Ч', '\u0448' => 'ш', '\u0428' => 'Ш', '\u0449' => 'щ', '\u0429' => 'Щ', '\u044a' => 'ъ', '\u042a' => 'Ъ', '\u044b' => 'ы', '\u042b' => 'Ы', '\u044c' => 'ь', '\u042c' => 'Ь', '\u044d' => 'э', '\u042d' => 'Э', '\u044e' => 'ю', '\u042e' => 'Ю', '\u044f' => 'я', '\u042f' => 'Я', '\r' => '', '\n' => '<br />', '\t' => '');
	foreach ($cyr_chars as $cyr_char_key => $cyr_char)
		$json_str = str_replace($cyr_char_key, $cyr_char, $json_str);
	return $json_str;
}
function ch_mods($path){
	$files = scandir($path);
	$cleanPath = $path.'/';
	foreach($files as $t)
		if($t!="." && $t!=".."){
			$currentFile = $cleanPath.$t;
			if(is_dir($currentFile)){
				ch_mods($currentFile);
				chmod($currentFile, 0755);
			}else
                chmod($currentFile, 0644);
        }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>СИСТЕМА УПРАВЛЕНИЯ САЙТОМ</title>
	<link rel='stylesheet' type='text/css' href='css/main.css' media='all' />
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>
<body style="background:#5EACEB url(img/sinii-fon-oboi.jpg) no-repeat 50% 50%;background-attachment:fixed;">
	<pre style="width:980px;padding:10px;margin:0 auto;overflow:hidden;background:#fff;background:rgba(255,255,255,0.5);border-radius:10px;clear:both">
<?php
$import_xml = "";
if(isset($_FILES["import_xml"]["tmp_name"]) && move_uploaded_file($_FILES["import_xml"]["tmp_name"], "uploads/import.xml"))
	if(file_exists("uploads/import.xml"))
		$import_xml = "uploads/import.xml";
if(file_exists("../import_files/import.xml"))
	$import_xml = "../import_files/import.xml";
if($import_xml != ""){
	$array = xml2array(file_get_contents($import_xml), 1, 'attribute');
	lookupcat($array['КоммерческаяИнформация']['Классификатор']['Группы']['Группа']['Группы'], 0);
	mysql_query("UPDATE viz213_categories SET sort_id=id WHERE sort_id=0");
	mysql_query("UPDATE viz213_categories SET title=name, description=name, keywords=name, h1=name WHERE title=''");
	foreach($array['КоммерческаяИнформация']['Каталог']['Товары']['Товар'] AS $good){
		$cat_id = mysql_result(mysql_query("SELECT id FROM viz213_categories WHERE id_id='".$good['Группы']['Ид']['value']."'"),0);
		$exist_r = mysql_query("SELECT id FROM viz213_goods WHERE id_id='".$good['Ид']['value']."'");
		if($exist_r && mysql_num_rows($exist_r)==1){
			$last = mysql_result($exist_r, 0);
			mysql_query("UPDATE viz213_goods SET id_id='".$good['Ид']['value']."', shtrih='".$good['Штрихкод']['value']."', name='".$good['Наименование']['value']."', bazed='".json_fix_cyr(json_encode($good['БазоваяЕдиница']))."', znrek='".json_fix_cyr(json_encode($good['ЗначенияРеквизитов']['ЗначениеРеквизита']))."', date_create=NOW(), cat_id='".$cat_id."', logo='".$good['Картинка']['value']."' WHERE id=".$last);
		}else{
			mysql_query("INSERT INTO viz213_goods (id_id, shtrih, name, bazed, znrek, date_create, cat_id, logo) VALUES ('".$good['Ид']['value']."', '".$good['Штрихкод']['value']."', '".$good['Наименование']['value']."', '".json_fix_cyr(json_encode($good['БазоваяЕдиница']))."', '".json_fix_cyr(json_encode($good['ЗначенияРеквизитов']['ЗначениеРеквизита']))."', NOW(), '".$cat_id."', '".$good['Картинка']['value']."')");
			$last = mysql_result(mysql_query("SELECT id FROM viz213_goods ORDER BY id DESC LIMIT 0, 1"), 0);
		}
		mysql_query("DELETE FROM ".MySQLprefix."_good_chars_val WHERE good_id='".$last."'");
		foreach($good['ХарактеристикиТовара']['ХарактеристикаТовара'] AS $chr){
			$chr_r = mysql_query("SELECT id FROM viz213_good_chars WHERE name='".$chr['Наименование']['value']."'");
			if($chr_r && mysql_num_rows($chr_r)==1)
				$chr_id = mysql_result($chr_r, 0);
			else{
				mysql_query("INSERT INTO viz213_good_chars (name) VALUES ('".$chr['Наименование']['value']."')");
				$chr_id = mysql_result(mysql_query("SELECT id FROM viz213_good_chars ORDER BY id DESC LIMIT 0, 1"), 0);
			}
			mysql_query("INSERT INTO ".MySQLprefix."_good_chars_val (char_id, good_id, char_val) VALUES ('".$chr_id."', '".$last."', '".$chr['Значение']['value']."')");
		}
	}
	mysql_query("UPDATE viz213_goods SET sort_id=id WHERE sort_id=0");
	mysql_query("UPDATE viz213_goods SET title=name, description=name, keywords=name, h1=name WHERE title=''");
	unlink($import_xml);
	?>
Импорт категорий, товаров и характеристик завершен
	<?php
}

$offers_xml = "";
if(isset($_FILES["offers_xml"]["tmp_name"]) && move_uploaded_file($_FILES["offers_xml"]["tmp_name"], "uploads/offers.xml"))
	if(file_exists("uploads/offers.xml"))
		$offers_xml = "uploads/offers.xml";
if(file_exists("../import_files/offers.xml"))
	$offers_xml = "../import_files/offers.xml";
if($offers_xml != ""){
	$array = xml2array(file_get_contents($offers_xml), 1, 'attribute');
	foreach($array['КоммерческаяИнформация']['ПакетПредложений']['Предложения']['Предложение'] AS $good){
		$exist_r = mysql_query("SELECT id FROM viz213_goods WHERE id_id='".$good['Ид']['value']."'");
		if($exist_r && mysql_num_rows($exist_r)==1){
			$last = mysql_result($exist_r, 0);
			mysql_query("UPDATE viz213_goods SET price='".$good['Цены']['Цена']['ЦенаЗаЕдиницу']['value']."', stock='".$good['Количество']['value']."' WHERE id=".$last);
		}
	}
	unlink($offers_xml);
	?>
Импорт цен и наличия завершен
	<?php
}

$photos_zip = "";
if(isset($_FILES["photos_zip"]["tmp_name"]) && move_uploaded_file($_FILES["photos_zip"]["tmp_name"],"uploads/photos.zip"))
	if(file_exists("uploads/photos.zip"))
		$photos_zip = "uploads/photos.zip";
if(file_exists("../import_files/photos.zip"))
	$photos_zip = "../import_files/photos.zip";
if($photos_zip != ""){
	chmod("../import_files", 0777);
	include("pclzip.lib.php");
	$archive = new PclZip($photos_zip);
	$archive->extract("../");
	ch_mods($_SERVER['DOCUMENT_ROOT']."/import_files");
	unlink($photos_zip);
	?>
Импорт изображений завершен
	<?php
}
?>
	</pre>
</body>
</html>