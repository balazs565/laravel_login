<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
</head>
<body>

    <style>
         body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f1ee;
            color: #2e2b29;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2b2b2b;
            color: #fff;
            text-align: center;
            padding: 1.5rem 0;
            border-bottom: 5px solid #c59d5f;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
            font-size: 2.2rem;
            margin: 0;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #faf9f8;
            border: 1px solid #e0dcd8;
            border-left: 5px solid #c59d5f;
            margin-bottom: 1rem;
            padding: 1rem 1.2rem;
            border-radius: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        li:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        strong {
            font-size: 1.2rem;
            color: #2b2b2b;
        }

        a {
            text-decoration: none;
            color: #c59d5f;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .user-info {
            text-align: center;
            margin-bottom: 1rem;
            color: #555;
        }

        .no-services {
            text-align: center;
            color: #777;
            font-style: italic;
        }

        footer {
            text-align: center;
            margin: 2rem 0;
        }

        .back-link {
            color: #2b2b2b;
            text-decoration: none;
            font-weight: bold;
            background-color: #c59d5f;
            color: #fff;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .back-link:hover {
            background-color: #a37e47;
        }
        </style>


    <h1>Servicii</h1>

    @auth
        <p>Bine ai venit, {{ auth()->user()->name }}</p>
    @endauth

    @if(session('status'))
        <div style="color:green; text-align:center; margin:0.5rem 0">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div style="color:red; text-align:center; margin:0.5rem 0">
            {{ $errors->first() }}
        </div>
    @endif

    @if($services->isEmpty())
        <p>Momentan nu sunt disponibile servicii.</p>
    @else
        <ul>
            @foreach($services as $service)
                <li>
                    <strong>{{ $service->name ?? 'Untitled Service' }}</strong>
                    @if(isset($service->price))
                        &nbsp;—&nbsp; Pret: {{ number_format($service->price, 2) }}
                    @endif
                    @if(isset($service->duration))
                        &nbsp;—&nbsp; Durata: {{ $service->duration }} minute
                    @endif
                    @if(isset($service->timeslots_count))
                        &nbsp;—&nbsp; {{ $service->timeslots_count }} intervale
                    @endif
                    <div>
                        <a href="/services/{{ $service->id }}/timeslots">Vezi intervalele</a>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            | <a href="/admin/services/{{ $service->id }}/edit">Editeaza</a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="/dashboard">Inapoi</a></p>
</body>
</html>