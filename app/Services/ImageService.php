<?php

namespace App\Services;

use App\Usables\ReadWrite;
use Exception;
use Intervention\Image\ImageManagerStatic as Image;


class ImageService
{
    use ReadWrite;

    public function SaveImageFromWeb($image, string $folder, string &$fileName, string &$error)
    {
        try {
            $fileName = $folder . '/' . $fileName;
            $img = Image::make($image);
            // $img->resize(500, 250);
            $img->stream();
            $error = '';
            $isstored = $this->StoreImage($fileName, $img, $error);
            if (!$isstored) {
                throw new Exception("Store Exception : " . __METHOD__ . " image store failed " . $error);
            }
            return true;
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            return false;
        }
    }
}
