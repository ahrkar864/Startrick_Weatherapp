<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        /* Basic styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: block;
        }

        input {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Weather App</h1>
        <form action="{{ route('weather.fetch') }}" method="POST">
            @csrf
            <label for="city">Enter City:</label>
            <input type="text" name="city" id="city" required>
            <button type="submit">Get Weather</button>
        </form>

        @if($errors->any())
            <div class="error">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif
    </div>
</body>
</html>

