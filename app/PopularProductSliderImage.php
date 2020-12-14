<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularProductSliderImage extends Model
{
    public function popularproductslider()
    {
    	return $this->belongsTo(PopularProductSlider::class);
    }
}
