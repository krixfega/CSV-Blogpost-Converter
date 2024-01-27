<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 10px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .error {
            background-color: #ffcccc;
            color: #cc0000;
        }

        .success {
            background-color: #ccffcc;
            color: #006600;
        }
    </style>
</head>
<body>
    {{-- <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/upload">Upload File</a></li>
        </ul>
    </nav> --}}

    <div style="text-align: center;">
        <h1>Upload XML/CSV File</h1>

        @if ($errors->any())
            <div class="message error">
                <strong>Error:</strong> {{ $errors->first('file') }}
            </div>
        @endif

        @if (session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @endif

        <form action="/upload" method="post" enctype="multipart/form-data">
            @csrf
            <label for="file">Choose file:</label>
            <input type="file" name="file" id="file">
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>
