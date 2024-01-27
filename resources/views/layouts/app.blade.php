<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'XML Converter')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
</head>
<body>

    <header>
        <!-- header content -->
        <h1>XML to BlogPost</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/upload">Upload File</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <!--  inject content of individual pages -->
        @yield('content')
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} XML Converter by Chris Fega. All rights reserved.</p>
    </footer>

   
   <script src="{{ asset('js/app.js') }}"></script 

</body>
</html>
