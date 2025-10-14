<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(auth()->user()->role=="admin")
    <title>Panou de control admin</title>
    @else
    <title>Panou de control utilizator</title>
    @endif
</head>
<body>

    <style>

body{
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}
h1 {
    color: #333;
    margin-bottom: 20px;
    text-align: center;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    position: relative;
}
h1::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 300%;
    height: 60%;
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
h2{
    color: #444;
    margin-top: 30px;
    margin-bottom: 10px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}
p{
    font-size: 1.2em;
    color: #555;
    text-align: center;
    margin-bottom: 20px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);

}

ul{
    list-style-type: none;
    padding: 0;
    margin: 0;

}
ul li{
    background: #fff;
    margin: 10px 0;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0
,0.1);
    transition: background 0.3s ease;
}
ul li:hover{
    background: #e9e9e9;
}
a{
    text-decoration: none;
    color: #53d7ff;
    font-weight: bold;
    transition: color 0.3s ease;
}
a:hover{
    text-decoration: underline;
}
button{
    background: #61eb52;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background 0.3s ease;
}
button:hover{
    background: #e04324;
}
   
.avatar {
    display: block;
    margin: 0 auto 20px auto;
    width: 120px;
    height: 120px;
    border-radius: 50%; 
    object-fit: cover; 
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    border: 3px solid white;
}
        </style>

    @if(auth()->user()->role=="admin")
        <h1>Panou de control admin</h1>
        @else
        <h1>Panou de control utilizator</h1>
        <p>Bine ai venit, {{ auth()->user()->name }}!</p>

        @endif
    @auth
          @if(auth()->user()->avatar)
        <img class="avatar" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar">
    @endif

     <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" style="text-align:center;margin-bottom:20px;">
        @csrf
        <input type="file" name="avatar" accept="image/jpeg,image/png,image/jpg" required>
        <button type="submit">Upload avatar</button>
    </form>
    @if(session('status'))
        <p style="color:green;text-align:center;">{{ session('status') }}</p>
    @endif

        @if(auth()->user()->role === 'admin')
            <h2>Panou de control admin</h2>
            <ul>
                <li><a href="/admin/services">Gestionare servicii (CRUD)</a></li>
                <li><a href="/admin/timeslots">Gestionare intervale (CRUD)</a></li>
                <li><a href="/admin/reservations">Gestionare rezervari (CRUD)</a></li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit">Dezlogare</button>
                    </form>
        @else
            <h2>Panou de control utilizator</h2>
            <ul>
                <li><a href="/services">Vizualizare servicii</a></li>

                <li><a href="/reservations">Rezervarile mele</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit">Dezlogare</button>
                    </form>
                </li>
            </ul>
        @endif
    @else
        <p>Te rog sa <a href="/login">te logezi</a> sau <a href="/register">te inregistrezi</a>.</p>
    @endauth
</body>
</html>