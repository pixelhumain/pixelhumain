<?php
if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }

if (version_compare(phpversion(), '5.0.0', '>=') !== true) {
    exit('Sorry, but you have to run this script with PHP5... You currently have the version <b>' . phpversion() . '</b>.');
}

if (!function_exists('imagecreate')) {
    exit('Sorry, make sure you have the GD extension installed before running this script.');
}

include_once('function.php');

// FileName & Extension
$system_temp_array = explode('/', $_SERVER['PHP_SELF']);
$filename = $system_temp_array[count($system_temp_array) - 1];
$system_temp_array2 = explode('.', $filename);
$availableBarcodes = listBarcodes();
$barcodeName = findValueFromKey($availableBarcodes, $filename);
$code = $system_temp_array2[0];

// Check if the code is valid
if (file_exists('config' . DIRECTORY_SEPARATOR . $code . '.php')) {
    include_once('config' . DIRECTORY_SEPARATOR . $code . '.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $barcodeName; ?> - Barcode Generator</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="jquery-1.7.2.min.js"></script>
        <script src="barcode.js"></script>
    </head>
    <body class="<?php echo $code; ?>">

<?php
$default_value = array();
$default_value['filetype'] = 'PNG';
$default_value['dpi'] = 72;
$default_value['scale'] = isset($defaultScale) ? $defaultScale : 1;
$default_value['rotation'] = 0;
$default_value['font_family'] = 'Arial.ttf';
$default_value['font_size'] = 8;
$default_value['text'] = '';
$default_value['a1'] = '';
$default_value['a2'] = '';
$default_value['a3'] = '';

$filetype = isset($_POST['filetype']) ? $_POST['filetype'] : $default_value['filetype'];
$dpi = isset($_POST['dpi']) ? $_POST['dpi'] : $default_value['dpi'];
$scale = intval(isset($_POST['scale']) ? $_POST['scale'] : $default_value['scale']);
$rotation = intval(isset($_POST['rotation']) ? $_POST['rotation'] : $default_value['rotation']);
$font_family = isset($_POST['font_family']) ? $_POST['font_family'] : $default_value['font_family'];
$font_size = intval(isset($_POST['font_size']) ? $_POST['font_size'] : $default_value['font_size']);
$text = isset($_POST['text']) ? $_POST['text'] : $default_value['text'];

registerImageKey('filetype', $filetype);
registerImageKey('dpi', $dpi);
registerImageKey('scale', $scale);
registerImageKey('rotation', $rotation);
registerImageKey('font_family', $font_family);
registerImageKey('font_size', $font_size);
registerImageKey('text', stripslashes($text));

// Text in form is different than text sent to the image
$text = convertText($text);
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <h1>Barcode Generator</h1>
    <h2>Barcode Generator</h2>
    <div class="configurations">
        <section class="configurations">
            <h3></h3>
            <table>
                <colgroup>
                    <col class="col1" />
                    <col class="col2" />
                </colgroup>
                <tbody>
                    <tr>
                        <td><label for="text">Data</label></td>
                        <td>
                            <div class="generate" style="float: left"><?php echo getInputTextHtml('text', $text, array('type' => 'text', 'required' => 'required')); ?> <input type="submit" value="Generate" name="submit"/></div>
                            <div class="possiblechars" style="float: right; position: relative;"><a href="#" class="info characters"><img src="info.gif" alt="Help" /></a></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>