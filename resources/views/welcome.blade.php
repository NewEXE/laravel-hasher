<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page Title</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('js/chosen/chosen.css') }}" />

    </head>
    <body>

    <h2>Laravel Hasher</h2>

    <form action="{{ route('store') }}" method="post">
        {{ csrf_field() }}

        <p>Select algorithm(s) or left blank for all possible:</p>
        <select data-placeholder="Select..." class="chosen-select" name="inputAlgorithms[]" multiple>
            <option></option>
            @foreach($algorithms as $algo)
                <option value="{{ $algo->id }}">{{ $algo->name }}</option>
            @endforeach
        </select>

        <p>Select at least one word for hashing:</p>
        <select data-placeholder="Select..." class="chosen-select" name="inputWords[]" multiple>
            <option></option>
            @foreach($words as $word)
                <option value="{{ $word->id }}">{{ $word->word }}</option>
            @endforeach
        </select>

        <input type="submit" />
    </form>

    <!-- Scripts: jQuery, Chosen and main.js -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chosen/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

    </body>
</html>