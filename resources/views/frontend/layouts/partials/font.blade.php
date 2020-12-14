@php
use App\Font;
use App\Css;

$fonts = Font::where('status', 1)->get();
$cssfonts = Css::find(1);
@endphp
<style type="text/css">
	@foreach($fonts as $font)
	@font-face {
	  font-family: {{$font->font_name}};
	  src: url({{
	  	asset($font->font_location)
	  	}});
	}
	@endforeach

	@if(isset($cssfonts->body))
	body {
		font-family: {{$cssfonts->body}};
	}
	@endif

	@if(isset($cssfonts->menu))
	.main-menu ul li a {
    	font-family: {{$cssfonts->menu}};
	}
	@endif

	@if(isset($cssfonts->menu))
	h1, h2, h3, h4, h5, h6 {
	    font-family: {{$cssfonts->heading}};
	}
	@endif
</style>