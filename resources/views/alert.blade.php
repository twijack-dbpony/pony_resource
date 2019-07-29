@if ($errors->any())
    <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif