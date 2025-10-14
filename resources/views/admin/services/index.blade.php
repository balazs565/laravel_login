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

     <h1>Gestionare Servicii</h1>

    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Adauga Serviciu</a>

    <table>
        <thead>
            <tr>
                <th>Nume</th>
                <th>Orar</th>
                <th>Actiune</th>
            </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>-
                <td>{{ $service->name }}</td>
                <td>{{ $service->timeslots_count }}</td>
                <td>
                    <a href="{{ route('admin.services.edit', $service) }}">Editeaza</a> |
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this service?')">Sterge</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="button" name="back" onclick="window.location.href='{{ url('/dashboard')}}'">Inapoi</button>
</body>
</html>
