<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionare Servicii</title>
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

    <table>
    <tr>
        <th>Serviciu</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Booked</th>
        <th>Actiuni</th>
    </tr>
    @foreach($timeslots as $t)
    <tr>
        <td>{{ $t->service->name }}</td>
        <td>{{ $t->start_time }}</td>
        <td>{{ $t->end_time }}</td>
        <td>{{ $t->booked ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('admin.timeslots.edit', $t) }}">Editeaza</a>
            <form action="{{ route('admin.timeslots.destroy', $t) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Sterge</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<button type="button" name="back" onclick="window.location.href='{{ url('/dashboard')}}'">Inapoi</button>
</body>
</html>
