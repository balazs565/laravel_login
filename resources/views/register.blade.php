<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            color: #222;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
            position: relative;
        }

        h1::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 250%;
            height: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            background: repeating-linear-gradient(
                45deg,
                red 0 15px,
                white 15px 30px,
                blue 30px 45px
            );
            z-index: -1;
            opacity: 0.1;
        }

        form {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        form div {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.3rem;
            font-weight: bold;
            color: #222;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #ff4b2b;
            outline: none;
            box-shadow: 0 0 5px rgba(255,75,43,0.5);
        }

        button {
            width: 100%;
            padding: 0.8rem;
            font-size: 1.1rem;
            font-weight: bold;
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: repeating-linear-gradient(
                45deg,
                red 0 10px,
                white 10px 20px,
                blue 20px 30px
            );
            transition: transform 0.3s, box-shadow 0.3s;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0,0,0,0.3);
        }

        .error {
            color: red;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        ul {
            list-style: none;
        }

        li {
            margin: 0.2rem 0;
        }
    </style>
</head>
<body>
    <div>
        <h1>Register</h1>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <div>
                <label>Prenume</label>
                <input type="text" name="name" value="{{ old('name') }}" required />
            </div>
            <div>
                <label>E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}" required />
            </div>
            <div>
                <label>Parola</label>
                <input type="password" name="password" required />
            </div>
            <div>
                <label>Confirmare Parola</label>
                <input type="password" name="password_confirmation" required />
            </div>
            <button type="submit">Inregistrare</button>
        </form>
    </div>
</body>
</html>
