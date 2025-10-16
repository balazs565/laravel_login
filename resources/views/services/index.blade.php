<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicii</title>
</head>
<body>
<style>
    
    body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
        background-color: #f4f4f9; 
        color: #333; 
        margin: 0;
        padding: 20px;
        line-height: 1.6;
        max-width: 800px; 
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); 
        border-radius: 8px; 
        background-clip: padding-box; 
    }

    
    h1 {
        font-size: 2.2rem;
        color: #1a1a2e; 
        border-bottom: 2px solid #e0e0f0; 
        padding-bottom: 10px;
        margin-bottom: 20px;
        text-align: center;
    }

    
    div[style*="color:green"],
    div[style*="color:red"] {
        padding: 10px 15px;
        margin: 15px 0;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
        background-color: rgba(67, 160, 71, 0.1); 
        color: #2e7d32 !important;
        border: 1px solid #a5d6a7;
    }

    div[style*="color:red"] {
        background-color: rgba(229, 57, 53, 0.1); 
        color: #c62828 !important;
        border: 1px solid #ef9a9a;
    }

    ul {
        list-style: none; 
        padding: 0;
        margin-top: 30px;
    }

    li {
        background-color: #ffffff;
        padding: 15px 20px;
        margin-bottom: 15px;
        border-radius: 6px;
        border-left: 5px solid #4a90e2;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    li:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    li strong {
        font-size: 1.1rem;
        color: #1a1a2e;
        display: block; 
        margin-bottom: 5px;
    }

    
    li > * {
        font-size: 0.95rem;
        color: #555;
    }

    a {
        color: #4a90e2; 
        text-decoration: none; 
        font-weight: 500;
        transition: color 0.2s;
    }

    a:hover {
        color: #357bd8; 
        text-decoration: underline; 
    }

   
    li div {
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px dashed #eee; 
    }

    p {
        color: #666;
    }

    p:last-of-type {
        margin-top: 40px;
        text-align: center;
    }

    p a {
        padding: 5px 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
    }

    p a:hover {
        background-color: #e9e9e9;
        text-decoration: none;
    }
        </style>


    <h1>Servicii</h1>

   

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
                            <a href="/admin/services/{{ $service->id }}/edit">Editeaza</a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="/dashboard">Inapoi</a></p>
</body>
</html>