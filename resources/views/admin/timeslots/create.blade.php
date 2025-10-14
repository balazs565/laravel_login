<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creare un interval</title>
</head>
<body>
    <h1>Adauga un interval</h1>

<form method="POST" action="{{ route('admin.timeslots.store') }}">
    @csrf

    <label for="service_id">Serviciu:</label>
    <select name="service_id" id="service_id" required>
        @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->name }}</option>
        @endforeach
    </select>

    <label for="start_time">Inceput:</label>
    <input type="datetime-local" name="start_time" id="start_time" required>

    <label for="end_time">Sfarsit:</label>
    <input type="datetime-local" name="end_time" id="end_time" required>

    <label>
        <input type="checkbox" name="booked" value="1"> Rezervat
    </label>

    <button type="submit">Adauga</button>
</form>
<button type="button" name="back" onclick="window.location.href='{{ url()->previous()}}'">Inapoi</button>
</body>
</html>