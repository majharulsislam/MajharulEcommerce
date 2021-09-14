<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function ParentorNotCategory($parent_id, $child_id){
        $categories = Category::where('id', $child_id)->where('parent_id', $parent_id)->get();
        if(!is_null($categories)){
            return true;
        }
        else{
            return false;
        }
    }

    protected $fillable = [
        'title','slug','description','image','parent_id',
    ];
}
