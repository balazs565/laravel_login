<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervari</title>
</head>
<body>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff1a1a;
        }
        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        form {
            display: inline;
        }
        form button {
            margin: 0;
        }
        form button:hover {
            background-color: #ff1a1a;
        }
        form button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        form {
            display: inline;
        }
        
    </style>

    <h1>Rezervarile mele</h1>

@if(session('status'))
    <p style="color: green;">{{ session('status') }}</p>
@endif

@if($reservations->isEmpty())
    <p>Nu ai nicio rezervare momentan.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Serviciu</th>
            <th>Timeslot</th>
            <th>Status</th>
        </tr>

        @foreach($reservations as $res)
        <tr>
            <td>{{ $res->service->name }}</td>
            <td>{{ $res->timeslot->start_time }} - {{ $res->timeslot->end_time }}</td>
            <td>
                @if($res->status === 'pending')
                    <span style="color: orange;">In asteptare</span>
                @elseif($res->status === 'confirmed')
                    <span style="color: green;">Confirmata</span>
                @elseif($res->status === 'canceled')
                    <span style="color: red;">Anulata</span>
                @endif
            </td>

            <td>
                 @if($res->status !== 'canceled')
                    <form method="POST" action="{{ route('reservations.destroy', $res) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Esti sigur ca vrei sa anulezi rezervarea?')">Anuleaza</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endif

<button onclick="window.location.href='/dashboard'">Inapoi</button>
</body>
</html>