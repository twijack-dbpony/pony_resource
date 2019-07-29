<?php
/**
 *|--------------------------------------------------------------------------
 *| Claim:By the power of Twilight Sparkle and Applejack,
 *| I hereby decree this function is feasible.
 *|--------------------------------------------------------------------------
 *|
 *| Created by PhpStorm.
 *| User: AppleSparkle
 *| Date: 6/3/19
 *| Time: 3:57 PM
 */

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
if(!function_exists('uploadImage')) {
    function uploadImage($file, $directory, $path = '', $resize = 'original')
    {
        if (is_array($directory)) {
            if (!File::exists($directory[0])) {
                foreach ($directory as $aj => $ts) {
                    if ($aj > 0) {
                        $name = $directory[0] . '/' . $ts;
                    }
                    File::makeDirectory($name, 0777, true, true);
                }
            }
            $path = $directory[0] . '/' . $path;
        } else {
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true, true);
            }
            $path = $directory;
        }

        $ImageName = config('constants.upload') . rand(0, 100) . '.' . config('constants.imageExtension');

        $image = Image::make($file);
        if ($resize != 'original') {
            $image->resize($resize, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        $image->save($path . '/' . $ImageName);

        return $ImageName;
    }
}