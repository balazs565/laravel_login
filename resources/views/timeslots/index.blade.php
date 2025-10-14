<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeslots for {{ $service->name ?? 'Service' }}</title>
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
    text-shadow: 1px 1px 2px rgba(0,0,
0,0.1);
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
}
li{
    background: #fff;
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
/* From Uiverse.io by Codecite */ 
.btn {
  transition: all 0.3s ease-in-out;
  font-family: "Dosis", sans-serif;
}

.btn {
  width: 150px;
  height: 60px;
  border-radius: 50px;
  background-image: linear-gradient(135deg, #feb692 0%, #ea5455 100%);
  box-shadow: 0 20px 30px -6px rgba(238, 103, 97, 0.5);
  outline: none;
  cursor: pointer;
  border: none;
  font-size: 24px;
  color: white;
}

.btn:hover {
  transform: translateY(3px);
  box-shadow: none;
}

.btn:active {
  opacity: 0.5;
}
    </style>

    <h1>Timeslots for {{ $service->name ?? 'Service' }}</h1>

    <p><a href="/services">Back to services</a></p>

    @if(session('status'))
        <div style="color:green; text-align:center; margin:0.5rem 0">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div style="color:red; text-align:center; margin:0.5rem 0">{{ $errors->first() }}</div>
    @endif

    @if($timeslots->isEmpty())
        <p>No timeslots available.</p>
    @else
        <ul>
            @foreach($timeslots as $slot)
                <li>
                    {{ $slot->start_time->format('Y-m-d H:i') }} — {{ $slot->end_time->format('H:i') }}
                    @if($slot->booked)
                        <strong style="color:gray">(Booked)</strong>
                    @else
                        <form method="POST" action="/reservations" style="display:inline">
                            @csrf
                            <input type="hidden" name="timeslot_id" value="{{ $slot->id }}" />
                            <button class="btn" type="submit">Rezerva</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>