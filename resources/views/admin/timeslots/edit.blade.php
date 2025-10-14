<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editare Interval</title>
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

        h1 {
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
            font-size: 2.2rem;
            margin: 0 0 1rem 0;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 2rem auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #c59d5f;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a67c3d;
        }
    </style>

    <h1>Editeaza Intervale</h1>

<form method="POST" action="{{ route('admin.timeslots.update', $timeslot) }}">
    @csrf
    @method('PUT')

    <label for="service_id">Serviciu:</label>
    <select name="service_id" id="service_id" required>
        @foreach($services as $service)
            <option value="{{ $service->id }}" {{ $service->id == $timeslot->service_id ? 'selected' : '' }}>
                {{ $service->name }}
            </option>
        @endforeach
    </select>

    <label for="start_time">Inceput:</label>
    <input type="datetime-local" name="start_time" id="start_time" value="{{ $timeslot->start_time->format('Y-m-d\TH:i') }}" required>

    <label for="end_time">Sfarsit:</label>
    <input type="datetime-local" name="end_time" id="end_time" value="{{ $timeslot->end_time->format('Y-m-d\TH:i') }}" required>

    <label>
        <input type="checkbox" name="booked" value="1" {{ $timeslot->booked ? 'checked' : '' }}> Rezervat
    </label>

    <button type="submit">Update</button>
</form>
<button type="button" name="back" onclick="window.location.href='{{ url()->previous()}}'">Inapoi</button>
</body>
</html>