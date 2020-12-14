@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Edit Offer</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{route('admin.offer.update',$offer->id)}}" method="post">
              @csrf
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name" class="col-form-label">Offer Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$offer->name}}">
                </div>

                <div class="" style="max-width: 300px">
                  <label for="start" class="col-form-label">Start Date</label>
                    <input id="start" type="date" class="form-control" name="start" value="{{$offer->start}}">
                </div>

                <div class="" style="max-width: 300px">
                  <label for="end" class="col-form-label">End Date</label>
                    <input id="end" type="date" class="form-control" name="end" value="{{$offer->end}}">
                </div>
                <br>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="continue" name="continue" @if($offer->continue == 1) checked="" @endif>
                  <label class="form-check-label" for="continue">Continue</label>
                </div>
                <br>
              <div class="form-group">
                  <input type="submit" class="btn btn-success" value="Edit">
              </div>
            </div>
            </form>   

        </div>

    </div>
</div>

@endsection

@section('script')

  <script type="text/javascript">
    $('#continue').click(function() { 
    $('#start').val('');  
    $('#end').val('');
    $('#continue').val(1);  
    });

    $('#start').click(function() { 
    $('#continue').prop('checked', false); 
    $('#continue').val(''); 
    });

    $('#end').click(function() { 
    $('#continue').prop('checked', false); 
    $('#continue').val('');
    });

  </script>

@endsection