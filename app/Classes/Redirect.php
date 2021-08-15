<?php

namespace App\Classes;

class Redirect {
  /**
   * Redirect to specific page
   * @param $page
   */
  static function to($page) {
    header("location: $page");
  }
}
