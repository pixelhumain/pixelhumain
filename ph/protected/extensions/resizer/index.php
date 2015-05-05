<?php
/**
 * File index.php
 *
 * @category   Extensions
 * @package    resizer
 * @author     Bogdan Burim <bgdn2007@ukr.net>
 * @copyright  2013 Bogdan Burim
 */

$dirname = RSZR_URI_EXPLODE_DELIMITER;

// Fetch params part
$pcs = explode($dirname, $_SERVER['REQUEST_URI']);
$q   = end($pcs);
$q   = trim($q, '/');

// Fetch dimensions
$pcs = explode('/', $q);
if (empty($pcs[0])) {
    die();
}

$dimensions = $pcs[0];
$pcs        = explode(RSZR_DIMENSIONS_DELIMITER, $dimensions);
if (empty($pcs)) {
    die();
}

$target_width  = $pcs[0];
$target_height = empty($pcs[1]) ? $pcs[0] : $pcs[1];
$target_width  = intval($target_width);
$target_height = intval($target_height);

if ($target_width < 1 || $target_height < 1) {
    die();
}

// Fetch and check image path
$pcs = explode('/', $q);
unset($pcs[0]);
foreach ($pcs as $k => $piece) {
    if ($piece == '..') {
        unset($pcs[$k]);
    }
}

$img_path            = implode(DS, $pcs);
$original_image_path = RSZR_ORIGINALS_BASE_PATH . $img_path;

// Make sure original image exists
if (!file_exists($original_image_path)) {
    die();
}

// Determine file extension
$pcs = explode('.', $img_path);
$ext = strtoupper(end($pcs));

$content_type = 'application/octet-stream';

switch ($ext) { 
    case "GIF"  : $content_type="image/gif"; break; 
    case "PNG"  : $content_type="image/png"; break; 
    case "JPEG" : 
    case "JPG"  : $content_type="image/jpg"; break; 
}

// Fire header out
header("Content-Type: $content_type"); 

// Search for image in cache
$hash_key  = md5($img_path) . "_{$target_width}x{$target_height}" . '.' . $ext;
$hash_path = RSZR_CACHED_IMAGES_PATH . $hash_key;

if (file_exists($hash_path)) {
    readfile($hash_path);
    die();
}

// Need to resize, read some info about image.
$imagesize   = @getimagesize($original_image_path);
$image_fname = $original_image_path;

if (is_array($imagesize)) {

    $imagetype = isset($imagesize[2]) ? $imagesize[2] : false;

    if ($imagetype && ($imagetype == IMAGETYPE_JPEG || $imagetype == IMAGETYPE_BMP || $imagetype == IMAGETYPE_PNG || $imagetype == IMAGETYPE_GIF)) {

        list($original_width, $original_height) = $imagesize;

        $dimensions = array(
            'w' => $target_width,
            'h' => $target_height
        );

        if ($original_width < $target_width && $original_height < $target_height) {

            $tmpImage = imagecreatetruecolor($dimensions['w'], $dimensions['h']);
            $bgcolor  = imagecolorallocate($tmpImage, 255, 255, 255);
            imagefill($tmpImage, 0, 0, $bgcolor);

            $imageCreateParams = array();
            switch ($imagetype) {
                case IMAGETYPE_JPEG:
                    $imageFunctionTail   = "jpeg";
                    $imageCreateParams[] = 85;
                break;

                case IMAGETYPE_GIF:
                    $imageCreateParams[] = 85;
                    $imageFunctionTail   = "gif";
                break;

                case IMAGETYPE_PNG:
                    $imageCreateParams[] = 7;
                    $imageFunctionTail   = "png";
                break;

                case IMAGETYPE_BMP:
                    $imageFunctionTail   = "bmp";
                    $imageCreateParams[] = 85;
                break;
            }

            $sourceImage = call_user_func("imagecreatefrom" . $imageFunctionTail, $image_fname);

            if ($imagetype === IMAGETYPE_GIF || $imagetype === IMAGETYPE_PNG) {
                $trnprt_indx = imagecolortransparent($sourceImage);
                if ($trnprt_indx >= 0) {
                    $trnprt_color = imagecolorsforindex($sourceImage, $trnprt_indx);
                    $trnprt_indx = imagecolorallocate($tmpImage, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($tmpImage, 0, 0, $trnprt_indx);
                    imagecolortransparent($tmpImage, $trnprt_indx);
                } elseif ($imagetype === IMAGETYPE_PNG) {
                    imagealphablending($tmpImage, false);
                    $color = imagecolorallocatealpha($tmpImage, 0, 0, 0, 127);
                    imagefill($tmpImage, 0, 0, $color);
                    imagesavealpha($tmpImage, true);
                }
            }

            $offset_left = intval(($target_width  - $original_width)  / 2);
            $offset_top  = intval(($target_height - $original_height) / 2);

            imagecopyresampled($tmpImage, $sourceImage, $offset_left, $offset_top, 0, 0, $original_width, $original_height, $original_width, $original_height);
            call_user_func_array("image" . $imageFunctionTail, array($tmpImage, $hash_path) + $imageCreateParams);
            sleep(1);
            imagedestroy($sourceImage);
            imagedestroy($tmpImage);

        } else {
            $width_ratio  = $dimensions['w'] / $original_width;
            $height_ratio = $dimensions['h'] / $original_height;

            $resize_aspect_ratio = max($width_ratio, $height_ratio);
            if ($resize_aspect_ratio < 1) {
                $width  = $original_width  * $resize_aspect_ratio;
                $height = $original_height * $resize_aspect_ratio;
            } else {
                $width  = $original_width;
                $height = $original_height;
            }
            $width  = intval($width);
            $height = intval($height);

            $resizedImage = imagecreatetruecolor($dimensions['w'], $dimensions['h']);
            $tmpImage     = imagecreatetruecolor($width, $height);

            $imageCreateParams = array();
            switch ($imagetype) {
                case IMAGETYPE_JPEG:
                    $imageFunctionTail   = "jpeg";
                    $imageCreateParams[] = 85;
                break;

                case IMAGETYPE_GIF:
                    $imageCreateParams[] = 85;
                    $imageFunctionTail   = "gif";
                break;

                case IMAGETYPE_PNG:
                    $imageCreateParams[] = 7;
                    $imageFunctionTail   = "png";
                break;

                case IMAGETYPE_BMP:
                    $imageFunctionTail   = "bmp";
                    $imageCreateParams[] = 85;
                break;
            }

            $sourceImage = call_user_func("imagecreatefrom" . $imageFunctionTail, $image_fname);

            if ($imagetype === IMAGETYPE_GIF || $imagetype === IMAGETYPE_PNG) {
                $trnprt_indx = imagecolortransparent($sourceImage);
                if ($trnprt_indx >= 0) {
                    $trnprt_color = imagecolorsforindex($sourceImage, $trnprt_indx);
                    $trnprt_indx = imagecolorallocate($tmpImage, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($tmpImage, 0, 0, $trnprt_indx);
                    imagecolortransparent($tmpImage, $trnprt_indx);
                } elseif ($imagetype === IMAGETYPE_PNG) {
                    imagealphablending($tmpImage, false);
                    $color = imagecolorallocatealpha($tmpImage, 0, 0, 0, 127);
                    imagefill($tmpImage, 0, 0, $color);
                    imagesavealpha($tmpImage, true);
                }
            }

            imagecopyresampled($tmpImage, $sourceImage, 0, 0, 0, 0, $width, $height, $original_width, $original_height);

            if ($height > $dimensions['h']) {
                $offset_top = intval(($height - $dimensions['h']) / 2);
                imagecopyresampled($resizedImage, $tmpImage, 0, 0, 0, $offset_top, $dimensions['w'], $dimensions['h'], $dimensions['w'], $dimensions['h']);
                $tmpImage = $resizedImage;
            } else if ($width > $dimensions['w']) {
                $offset_left = intval(($width - $dimensions['w']) / 2);
                imagecopyresampled($resizedImage, $tmpImage, 0, 0, $offset_left, 0, $dimensions['w'], $dimensions['h'], $dimensions['w'], $dimensions['h']);
                $tmpImage = $resizedImage;
            }

            call_user_func_array("image" . $imageFunctionTail, array($tmpImage, $hash_path) + $imageCreateParams);
            sleep(1);
            imagedestroy($sourceImage);
            imagedestroy($tmpImage);

        }
    }
}

// Try to read image from cache again
if (file_exists($hash_path)) {
    readfile($hash_path);
    die();
}


