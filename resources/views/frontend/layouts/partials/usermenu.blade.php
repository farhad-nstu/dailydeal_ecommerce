@if(Auth::guard('web')->check())
{{-- User menu start here --}}
<div class="container" style="padding-top: 120px;">
<nav class="navbar navbar-expand-lg navbar-light bg-light text-right">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>hgjhjghjfjgjhgjf
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.profile.myaccounts')}}">My Accounts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.profile.orders')}}">Orders</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('wishlists')}}">Wishlists</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
      </li>
      
      
    </ul>
    
  </div>
</nav>
</div>
{{-- User menu end here --}}
@endif