<?php namespace App\Helpers;
use Auth;
use Request;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Requests;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input as Input;

class FileHelper  {

    public static function storeImage($inputName = 'image', $folderName = 'uploads', $width = 200, $height = 200, $pre = '') {


        if (!Request::hasFile($inputName)) {
            return false;
        }

        $size = getimagesize($_FILES[$inputName]['tmp_name']);

        if(intval($_FILES[$inputName]['size']) > 500000)
            return Redirect::back()->withErrors([ 'لقد تجاوزت الحد الأقصى للصورة']);

            $actualWidth = $size[0];
            $actualHeight = $size[1];
            $widthRatio = $actualWidth / $width;
            $heightRatio = $actualHeight / $height;

            if($heightRatio > $widthRatio){
                //height still as it
                $width = $actualWidth/$heightRatio;
            }else{
                //width still as it
                $height = $actualHeight / $widthRatio;
            }

            //$file = Request::file('logo');
//            $ext      = Input::file($inputName)->getClientOriginalExtension();
            // $fileName = time().'.'.$ext;

            if (!is_dir(base_path()."/".$folderName."/".date("Y-m-d"))) {
                mkdir(base_path()."/".$folderName."/".date("Y-m-d"), 0777, TRUE);
            }

            $image = Input::file($inputName);
            $fileName  = $pre . time() . '.' . $image->getClientOriginalExtension();

            $path = base_path()."/".$folderName."/".date("Y-m-d") . '/' . $fileName;

            //width , height
            Image::make($image->getRealPath())->resize($width, $height)->save($path);
            return $folderName."/".date("Y-m-d") . '/' . $fileName;
            //$user->image = $filename;
            //$user->save();

    }//end store single


    //return file url
    public static function upload_file($inputName = 'file', $folderName = 'uploads') {
        if (Request::hasFile($inputName)) {

            $folderPath = base_path()."/".$folderName."/".date("Y-m-d");
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, TRUE);
            }

            $file = Input::file($inputName);
            $fileName  = time() . '.' . $file->getClientOriginalExtension();



            Input::file($inputName)->move($folderPath, $fileName);

            return $folderName."/".date("Y-m-d") . '/' .$fileName;
        }
        return FALSE;
    }//end store single

    public static  function multiple_upload_images( $inputName, $folderName, $width, $height, $pre='') {
        if (empty($_FILES[$inputName])) {
            return false;
        }

        if(intval($_FILES[$inputName]['size']) > 500000)
            return Redirect::back()->withErrors([ 'لقد تجاوزت الحد الأقصى للصورة']);

        $defaultWidth = $width;
        $defaultHeight = $height;
        // getting all of the post data
        $files = Input::file($inputName);
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        $images = array();

        foreach ($files as $index => $image) {
            $width = $defaultWidth;
            $height = $defaultHeight;
            $rules     = array('file'                 => 'required|image');//'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $image), $rules);
            if ($validator->passes()) {

                $size = getimagesize($_FILES[$inputName]['tmp_name'][$index]);

                if(intval($_FILES[$inputName]['tmp_name'][$index]) > 500000)
                    return Redirect::back()->withErrors([ 'لقد تجاوزت الحد الأقصى للصورة']);

                    $actualWidth = $size[0];
                    $actualHeight = $size[1];
                    $widthRatio = $actualWidth / $width;
                    $heightRatio = $actualHeight / $height;

                    if($heightRatio > $widthRatio){
                        //height still as it
                        $width = $actualWidth/$heightRatio;
                    }else{
                        //width still as it
                        $height = $actualHeight / $widthRatio;
                    }


                if (!is_dir(base_path()."/".$folderName."/".date("Y-m-d"))) {
                    mkdir(base_path()."/".$folderName."/".date("Y-m-d"), 0777, TRUE);
                }

                $fileName  = $pre . time() . $index . '.' . $image->getClientOriginalExtension();

                $path = base_path()."/".$folderName."/".date("Y-m-d") . '/' . $fileName;

                //width , height
                Image::make($image->getRealPath())->resize($width, $height)->save($path);
                $images[] = $folderName."/".date("Y-m-d") . '/' . $fileName ;



            }//end validator pass condition

        }//end foreach
        return $images;
    }//end store multi


}//end File Helper