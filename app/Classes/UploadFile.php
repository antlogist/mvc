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
  
  protected function setName($file, $name = "") {
    if ($name === "") {
      $name = pathinfo($file, PATHINFO_FILENAME);
    }
    
    $name = strtolower(str_replace(["_", " "], "-", $name));
    
    $hash = md5(microtime());
    
    $ext = $this->fileExtension();
    
    $this->filename = "{$name}-{$hash}.{$ext}";
  }
  
  protected function fileExtension($file) {
    return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
  }
  
}
