<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Password Generator')
    </title>

    <meta charset='utf-8'>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
	  <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
    <link href="/css/password.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header>
        <img
        src='https://s3-us-west-1.amazonaws.com/dwa15/password_photo.jpg'
        style='width:300px'
        alt='Foobooks Logo'>
    </header>

    <section>
        @yield('content')
    </section>

    <footer>
        &copy; {{ date('Y-m-d H:i:s') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
