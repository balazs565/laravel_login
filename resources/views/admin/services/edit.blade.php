<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editeaza Serviciu</title>
</head>
<body>
    <style>
        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
        }
        label {
            margin-top: 10px;
        }
        input {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
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

     <h1>Editeaza Serviciu</h1>

    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @csrf
        @method('PUT')

        <label>Nume:</label>
        <input type="text" name="name" value="{{ $service->name }}" required>

        <label>Pret:</label>
        <input type="number" name="price" value="{{ $service->price }}" step="0.01" required>

        <label>Durata:</label>
        <input type="number" name="duration" value="{{ $service->duration }}" required>

        <button type="submit">Update</button>
    </form>
    <button type="button" name="back" onclick="window.location.href='{{ url()->previous()}}'">Inapoi</button>
</body>
</html>