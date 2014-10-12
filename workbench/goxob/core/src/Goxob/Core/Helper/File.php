<?php

namespace Goxob\Core\Helper;


class File {
    public static function formatFileName($file)
    {
        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename  =  basename($filename,'.'.$extension);
        $id = date('ymdhis');
        $filename = $filename."_".$id.'.'.$extension;
        return $filename;
    }

    public static function createThumbs( $file, $uploadDir, $nw = 256,  $nh = 256)
    {
        $allowed_types = array('jpg','jpeg','gif','png');

        /* Skipping the system files: */
        if($file=='.' || $file == '..') return;

        $file_parts = explode('.',$file);    //This gets the file name of the images
        $ext = strtolower(array_pop($file_parts));

        /* Using the file name (withouth the extension) as a image title: */
        $title = implode('.',$file_parts);
        $title = htmlspecialchars($title);

        /* If the file extension is allowed: */
        if(in_array($ext,$allowed_types))
        {
            $source = $uploadDir.'/'.$file;
            $stype = explode(".", $source);
            $stype = $stype[count($stype)-1];
            $dest = $uploadDir.'/'.$title.'_thumb.'.$ext;

            $size = getimagesize($source);
            $w = $size[0];
            $h = $size[1];

            switch($stype) {
                case 'gif':
                    $simg = imagecreatefromgif($source);
                    break;
                case 'jpeg':
                case 'jpg':
                    $simg = imagecreatefromjpeg($source);
                    break;
                case 'png':
                    $simg = imagecreatefrompng($source);
                    break;
            }

            $dimg = imagecreatetruecolor($nw, $nh);
            if($stype == 'png'){
                imagealphablending($dimg,false);
                imagesavealpha($dimg,true);
            }

            // copy and resize old image into new image
            imagecopyresampled( $dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h );

            switch($stype) {
                case 'gif':
                    imagegif($dimg,$dest);
                    break;
                case 'jpeg':
                case 'jpg':
                    imagejpeg($dimg,$dest,100);
                    break;
                case 'png':
                    imagepng($dimg,$dest);
                    break;
            }

            return $dimg;
        }
    }
}