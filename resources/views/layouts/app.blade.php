<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your App Name')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<body>

    <header>
        <!-- header content -->
        <h1>Your App Name</h1>
        <!-- Navigation links, user authentication status, etc. -->
    </header>

    <main>
        <!-- This is where the content of your individual pages will be injected -->
        @yield('content')
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} Converter. All rights reserved.</p>
    </footer>

   
   <script src="{{ asset('js/app.js') }}"></script 

</body>
</html>
