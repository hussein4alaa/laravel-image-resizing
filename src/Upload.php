<?php

namespace g4t\ImageResizing;


class Upload
{


    public static function file($image, $type)
    {
        $config = config("ImageResizing.sizes.{$type}");
        $height = $config['height'];
        $width = $config['width'];
        $extension = $image->getClientOriginalExtension();
        $check = self::checkExtension($extension);


        if ($check['status'] !== true) {
            return response()->json(["error" => $check['status']], 403);
        }

        $uploadPath = $image->store($config['path']);
        $path = self::path();


        $full_path = $path . '/' . $uploadPath;
        $imageName = $image->hashName();
        preg_match("'^(.*)\.(gif|jpe?g|png)$'i", $imageName, $ext);
        switch (strtolower($extension)) {
            case 'jpg':
            case 'jpeg':
                $im   = imagecreatefromjpeg($full_path);
                break;
            case 'gif':
                $im   = imagecreatefromgif($full_path);
                break;
            case 'png':
                $im   = imagecreatefrompng($full_path);
                break;
            default:
                $stop = true;
                break;
        }
        if (!isset($stop)) {
            $x = imagesx($im); // width
            $y = imagesy($im);  // height
            if(is_null($width) && is_null($height)) {
                $height = $y;
                $width = $x;
                $config['save_orginal'] = false;
            }else if(is_null($height) OR is_null($width)) {
                if(is_null($height)) {
                    $rato = $width / $x * 100;
                    $height = $y * (int)$rato / 100;
                    $height = (int)$height;
                } else if(is_null($width)) {
                    $rato = $height / $y * 100;
                    $width = $x * (int)$rato / 100;
                    $width = (int)$width;
                }
            }

            $save = imagecreatetruecolor($width, $height);
            $new_path = $full_path . "_g4t_" . $height . "_" . $width . "." . $extension . "";
            imagecopyresized($save, $im, 0, 0, 0, 0, imagesx($save), imagesy($save), $x, $y);
            imagegif($save, $new_path);
            imagedestroy($im);
            imagedestroy($save);
            $copy_path = $uploadPath . "_g4t_" . $height . "_" . $width . "." . $extension;
            $images = [
                'orginal' => [
                    'path' => $config['full_url'] == true ? $config['base_url'] . '/' . $uploadPath :  $uploadPath,
                    'extension' => $extension,
                    'size' => filesize($full_path)
                ],
                'copy' => [
                    'path' => $config['full_url'] == true ? $config['base_url'] . '/' . $copy_path :  $copy_path,
                    'extension' => $extension,
                    'size' => filesize($new_path)
                ]
            ];
            if ($config['save_orginal'] == false) {
                unlink($full_path);
                unset($images['orginal']);
            }
            return $images;
        }
    }



    public static function checkExtension($extension)
    {
        $images = array('jpg', 'png', 'gif', 'jpeg');
            if (!in_array($extension, $images)) {
                return ["status" => "Allowed images : 'jpg', 'png', 'gif', 'jpeg'"];
            }
        return ["status" => true];
    }


    public static function path()
    {
        $default_path = config('filesystems.default');
        $path = config('filesystems.disks.' . $default_path . '.root');
        return $path;
    }
}
