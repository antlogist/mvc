<?php

namespace App\Classes;

class UploadFile {
  protected $filename;
  protected $max_filesize = 2097152;
  protected $extension;
  protected $path;
  
  /**
   * Get the file name
   */
  function getName() {
    return $this->filename;
  }
  
  /**
   * Set the name of the file
   * @param $file
   * @param [$name = ""]
   */
  protected function setName($file, $name = "") {
    if ($name === "") {
      $name = pathinfo($file, PATHINFO_FILENAME);
    }
    
    $name = strtolower(str_replace(["_", " "], "-", $name));
    
    $hash = md5(microtime());
    
    $ext = $this->fileExtension($file);
    
    $this->filename = "{$name}-{$hash}.{$ext}";
  }
  
  /**
   * Set the file extension
   * @param  $file
   * @return mixed
   */
  protected function fileExtension($file) {
    return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
  }
  
  /**
   * Check the file size
   * @param $file
   * @return bool
   */
  static function fileSize($file) {
    // in the static method we cannot use this
    $fileObj = new static;
    return $file > $fileObj->max_filesize ? true : false;
  }
  
  /**
   * Validate upload file
   * @param $file
   * @return boolean
   */
  static function isImage($file) {
    $fileObj = new static;
    $ext = $fileObj->fileExtension($file);
    $validExt = array("jpg", "jpeg", "png", "bmp", "gif");
    
    if (!in_array(strtolower($ext), $validExt)) {
      return false;
    }
    
    return true;
  }
  
  /**
   * Get the path where image was uploaded to
   * @return mixed
   */
  function path() {
    return $this->path;
  }
  
  /**
   * Move the file to the intended location
   * @param $temp_path
   * @param $folder
   * @param $file
   * @param $new_filename
   * @return null|static
   */
  static function move($temp_path, $folder, $file, $new_filename = "") {
    $fileObj = new static;
    $ds = DIRECTORY_SEPARATOR;
    
    $fileObj->setName($file, $new_filename);
    $file_name = $fileObj->getName();
    
    if (!is_dir($folder)) {
      //create a dirictory with special permission
      mkdir($folder, 0777, true);
    }
    
    $fileObj->path = "{$folder}{$ds}{$file_name}";
    
    //from _env.php
    $absolute_path = BASE_PATH."{$ds}public{$ds}$fileObj->path";
    
    if (move_uploaded_file($temp_path, $absolute_path)) {
      return $fileObj;
    }
    
    return null;
  }
}
