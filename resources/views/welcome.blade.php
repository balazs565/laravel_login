<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop</title>
    <style>
     
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f2f2f2;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 2rem;
            color: #222;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            position: relative;
        }

      
        h1::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            background: repeating-linear-gradient(
                45deg,
                red 0 20px,
                white 20px 40px,
                blue 40px 60px
            );
            z-index: -1;
            opacity: 0.2;
        }

        
        .barber-btn {
            position: relative;
            display: inline-block;
            padding: 1rem 2rem;
            margin: 0.5rem;
            font-size: 1.2rem;
            color: rgb(0, 0, 0);
        
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            background: repeating-linear-gradient(
                45deg,
                red 0 10px,
                white 10px 20px,
                blue 20px 30px
            );
            border: 2px solid #222;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .barber-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <h1>Bine ai venit la noi!</h1>
    <a href="/login" class="barber-btn">Logare</a>
    <a href="/register" class="barber-btn">Inregistrare</a>
</body>
</html>
