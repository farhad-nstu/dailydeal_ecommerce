@php
use App\Review;

    $reviews = Review::where('product_id',$product->id)->get();
    $totalrow = 0;
    if (count($reviews) >0 ) {
        
        $totalrating = 0;
        foreach ($reviews as $review) {
             $totalrating += $review->rating; 
         }
         $totalrow = count($reviews);
         $avarage_rating = $totalrating/$totalrow;

         if (is_float($avarage_rating) == TRUE) {
             $rating = $avarage_rating + 1;
             $final_rating = intval($rating);
         }
         else {
            $final_rating = $avarage_rating;
         }

         

        $rating = $final_rating;
     } 
     else {
        $rating = 0;
     }

@endphp  



<span class="rating">
    @foreach(range(1,5) as $i)
    <span class="fa-stack" style="width:1em">
        <i class="far fa-star fa-stack-1x"></i>

        @if($rating >0)
            @if($rating >0.5)
                <i class="fas fa-star fa-stack-1x"></i>
            @else
                <i class="fas fa-star-half fa-stack-1x"></i>
            @endif
        @endif
        @php $rating--; @endphp
    </span>
@endforeach