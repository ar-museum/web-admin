@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger no-border-radius">
        <strong>Whoops! Ceva nu e in regula!</strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif