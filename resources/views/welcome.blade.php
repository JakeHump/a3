@extends('layouts.master')

@section('title')
    Password Generator
@endsection

@section('content')
     <h1>Create a strong password</h1>

     <form method='GET' action='/'>

        <br>

        <label for='length'><strong>Length 7-12 chars (REQUIRED)</strong></label>
        <input type='number' name='length' id='length' size='5' min='7' max='12' value='{{ $length or '' }}' >

        <br>

        <p><strong>At least one box is REQUIRED to be checked</strong></p>

        <input type='checkbox' name='includeCapitals' id='includeCapitals' {{ ($includeCapitals) ? 'CHECKED' : '' }} >
        <label for='includeCapitals'>Include Capital Letters</label>

        <br>

        <input type='checkbox' name='includeLowers' id='includeLowers' {{ ($includeLowers) ? 'CHECKED' : '' }} >
        <label for='includeLowers'>Include Lowercase Letters</label>

        <br>

        <input type='checkbox' name='includeNumbers' id='includeNumbers' {{ ($includeNumbers) ? 'CHECKED' : '' }} >
        <label for='includeNumbers'>Include Numbers</label>

        <br>

        <input type='checkbox' name='includeSymbols' id='includeSymbols' {{ ($includeSymbols) ? 'CHECKED' : '' }} >
        <label for='includeSymbols'>Include Symbols</label>

        <br>

        <label for='lastChar'>Define the Last Character (OPTIONAL)</label>
        <input type='text' name='lastChar' id='lastChar' size='5' maxlength='1' value='{{ $lastChar or '' }}' >

        <br>

        <input type='submit' name='submit' class='btn btn-primary btn-small' value='Generate Password'>

    </form>

    @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @else
        @if (!empty($finalPassword))
            <h2>  {{ $finalPassword or ' ' }} </h2>
        @endif
    @endif

@endsection
