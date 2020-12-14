<div class="section-wrapper col-md-12">

    {{-- <div class="col-md-3">
    <ul class="list-group">
      <div id="subcategory">

      @foreach(App\Category::orderBy('name','asc')->where('parent_id', $category->id)->get() as $child)
      <a class="list-group-item list-group-item-action" href="{{route('category.show',$child->slug)}}">
        @if(isset($child->image))
        <img src="{{ asset('images/categories/'.$child->image) }}" width="20">
        @else <img src="{{ asset('images/no-img.jpg') }}" width="20">
        @endif

        @if(Config::get('app.locale') == 'bd')

            @if(!is_null($child->name_bd))
                {{ $child->name_bd }}
            @else
                {{ $child->name }}
            @endif

        @elseif(Config::get('app.locale') == 'en')
            {{ $child->name }}
        @endif

      </a>
      @endforeach

      </div>
    </ul>
</div> --}}