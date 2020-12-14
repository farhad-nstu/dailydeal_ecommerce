@extends('backend.layouts.master')
@extends('frontend.layouts.reviewstyle')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Edit review</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.review.update', $review->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="user_name" value="{{ $review->user_name }}">
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input id="email" type="text" class="form-control" name="user_email" value="{{ $review->user_email }}">
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-12">
                        <div class="rating">
                            <span class="rating-title">Your Rating : 
                                <div class="wrapper">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" @if($review->rating == 5) checked="" @endif /><label class = "full" for="star5" title="Awesome - 5 stars"></label>

                                        <input type="radio" id="star4" name="rating" value="4" @if($review->rating == 4) checked="" @endif /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                       
                                        <input type="radio" id="star3" name="rating" value="3" @if($review->rating == 3) checked="" @endif /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                       
                                        <input type="radio" id="star2" name="rating" value="2" @if($review->rating == 2) checked="" @endif /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                        
                                        <input type="radio" id="star1" name="rating" value="1" @if($review->rating == 1) checked="" @endif /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        
                                    </fieldset>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user_message">Message</label>
                    <textarea class="form-control" id="user_message" rows="3" name="user_message">{{$review->user_message}}</textarea>
                </div>

                <div class="form-group">
                    
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection