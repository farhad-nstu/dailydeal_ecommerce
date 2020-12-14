<div class="section-wrapper col-md-12">

    <div class="col-md-3">
    <ul class="list-group">
      @foreach(App\Category::orderBy('name','asc')->get() as $category)
      <a class="list-group-item list-group-item-action"  href="{{route('category.show',$category->slug)}}">
        @if(isset($category->image))
        <img src="{{ asset('images/categories/'.$category->image) }}" width="50">
        @else <img src="{{ asset('images/no-img.jpg') }}" width="50">
        @endif
        @if(Config::get('app.locale') == 'bd')

            @if(!is_null($category->name_bd))
                {{ $category->name_bd }}
            @else
                {{ $category->name }}
            @endif

        @elseif(Config::get('app.locale') == 'en')
            {{ $category->name }}
        @endif
      </a>
      {{-- <div class="collapse" id="subcategory{{$parent->id}}">

      @foreach(App\Category::orderBy('name','asc')->where('parent_id', $parent->id)->get() as $child)
      <a class="list-group-item list-group-item-action" data-toggle="collapse" href="#subcategory{{$child->id}}">
        -
        @if(isset($child->image))
        <img src="{{ asset('images/categories/'.$child->image) }}" width="20">
        @else <img src="{{ asset('images/no-img.jpg') }}" width="20">
        @endif
        {{$child->name}}
      </a>
      @endforeach

      </div> --}}
      @endforeach
    </ul>
</div>