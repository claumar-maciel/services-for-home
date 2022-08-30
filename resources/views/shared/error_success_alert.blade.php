@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
