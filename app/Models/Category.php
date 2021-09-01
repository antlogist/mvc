<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\SubCategory;

class Category extends Model {
  
  use SoftDeletes;
  
  public $timestamps = true;
  protected $fillable = ["name", "slug"];
  protected $dates = ["deleted_at"];
  
  function products() {
    return $this->hasMany(Product::class);
  }
  
  function subCategories() {
    return $this->hasMany(SubCategory::class);
  }
  
  function transform($data) {
    $categories = [];
    foreach($data as $item) {
      $added = new Carbon($item->created_at);
      array_push($categories, [
        "id" => $item->id,
        "name" => $item->name,
        "slug" => $item->slug,
        "added" => $added->toFormattedDateString()
      ]);
    }
    return $categories;
  }
  
}
