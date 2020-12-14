<!-- /resources/views/post/create.blade.php -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))

	<div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
    </div>

@elseif(Session::has('danger'))

    <div class="alert alert-danger">
        <p>{{ Session::get('danger') }}</p>
    </div>

@endif

<!-- Create Post Form -->