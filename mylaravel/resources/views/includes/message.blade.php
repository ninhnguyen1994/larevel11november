@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <button class="close" type="button" data-dismis="alert" aria-hidden="true">x</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
