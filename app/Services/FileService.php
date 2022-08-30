<?php
namespace App\Services;
class FileService {

    /**
     * upload file in desire location with desire name
     * @param $name, $location, $file
     * @return $name
     */
    public function upload($name,$location,$file){
        $new_name = $name."_".rand(11,99).'.'.$file->getClientOriginalExtension();
        $file->move(public_path().$location,$new_name);
        return $new_name;
    }

    /**
     * delete image from desire location
     * @param $name, $location
     */
    public function delete($name,$location){
        unlink(public_path($location).$name);
        return back();
    }
}