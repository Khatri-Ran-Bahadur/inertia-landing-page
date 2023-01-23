<?php

/**
 * All Helper functions
 * 
 */

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



/**
 * MAKE AVATAR FUNCTION
 */
if (!function_exists('makeAvatar')) {
  function makeAvatar($fontPath, $path, $name, $char)
  {
    Storage::disk('public_uploads')->makeDirectory($path, 0777);
    $path = $path . $name;
    $image = imagecreate(200, 200);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);
    $textcolor = imagecolorallocate($image, 255, 255, 255);
    imagettftext($image, 100, 0, 50, 150, $textcolor, $fontPath, $char);
    header("Content-type: image/png");
    imagepng($image, public_path($path));
    imagedestroy($image);
    return $path;
  }
}


if (!function_exists('remove_space')) {
  function remove_space($number)
  {
    return str_replace(' ', '', $number);
  }
}

if (!function_exists('truncate')) {
  function truncate($string, $length)
  {
    return  Str::limit($string, $length, ' ...');
  }
}


if (!function_exists('number_format_fun')) {
  function number_format_fun($num)
  {
    return round($num, 2);
  }
}


/**
 * this function return dropdown button for admin panel
 */
if (!function_exists('make_button')) {
  function make_button($btn)
  {
    return '<div class="dropdown">
    <a class="btn btn-primary btn-xs custom dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
      ' . __('Action') . '
    </a>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    ' . $btn . '
    </ul>
  </div>';
  }
}

if (!function_exists('make_status')) {
  function make_status($url, $id, $val)
  {
    return '<div class="onoffswitch change-status-checkbox">
              <input type="checkbox" name="onoffswitch"  data-url="' . $url . '" class="onoffswitch-checkbox" id="statusOnOff' . $id . '" ' . ($val === 1 ? "checked" : "") . '>
              <label class="onoffswitch-label" for="statusOnOff' . $id . '">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
          </div>';
  }
}



/*
* remove base url of image
*/

function get_org_img($img)
{
  $img = str_replace(env('APP_URL'), "", $img);
  return $img;
}

function get_img($img)
{
  $img = asset($img);
  return $img;
}


/**
 * get thumb image of given image
 *  users/user_376521/photos/decl.png
 */
function get_thumb($image)
{
  $path = asset($image);
  $filename = pathinfo($path, PATHINFO_FILENAME) . '.' . pathinfo($path, PATHINFO_EXTENSION);
  $thumb_name = pathinfo($path, PATHINFO_FILENAME) . '_small.jpg';
  $final_thumb = str_replace($filename, "__thumbs/smart/" . $thumb_name, $path);
  return $final_thumb;
}
