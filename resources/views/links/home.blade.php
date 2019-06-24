<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>URL Shortener</title>
        <link rel="stylesheet" href="{{ URL::to('css/global.css') }}">
    </head>

    <body>
        <div class="container">
            <h1 class="title">URL Shortener</h1>

            @if($errors->has('url'))
                <p>{{ $errors->first('url') }}</p>
            @endif

            @if(Session::has('global'))
                <p>{!! Session::get('global') !!}</p>
            @endif

            <form action="{{ route('make') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="url" name="url" placeholder="http://..." autocomplete="off"{{ Input::old('url') ? ' value=' . e(Input::old('url')) . '' : ''}}>
                <input type="submit" value="Shorten">
            </form>
        </div>
    </body>

</html>