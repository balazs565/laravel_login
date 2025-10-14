<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionare rezervari</title>
</head>
<body>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        a:visited{
            color: blue;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <h1>Rezervări</h1>

<table>
    <tr>
        <th>User</th>
        <th>Service</th>
        <th>Timeslot</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    @foreach($reservations as $res)
    <tr>
        <td>{{ $res->user->name }}</td>
        <td>{{ $res->service->name }}</td>
        <td>{{ $res->timeslot->start_time }} - {{ $res->timeslot->end_time }}</td>
        <td>{{ ucfirst($res->status) }}</td>
        <td>
            @if($res->status === 'pending')
            <form method="POST" action="{{ route('admin.reservations.update', $res) }}" style="display:inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="confirmed">
                <button type="submit">Confirm</button>
            </form>
            @endif
               <form method="POST" action="{{ route('admin.reservations.update', $res) }}" style="display:inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="canceled">
                <button type="submit">Cancel</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<button type="button" name="back" onclick="window.location.href='{{ url('/dashboard')}}'">Inapoi</button>

</body>
</html>