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
    
    $ext = $this->fileExtension();
    
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
    $fileobj = new static;
    return $file > $fileobj->max_filesize ? true : false;
  }
  
  /**
   * Validate upload file
   * @param $file
   * @return boolean
   */
  static function isImage($file) {
    $fileobj = new static;
    $ext = $fileobj->fileExtension($file);
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
}
