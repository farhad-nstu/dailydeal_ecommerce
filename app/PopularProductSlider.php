<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularProductSlider extends Model
{
    public function images()
    {
    	return $this->hasMany('App\PopularProductSliderImage');
    }
}
