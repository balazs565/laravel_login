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



.button-33 {
  background-color: #c2fbd7;
  border-radius: 100px;
  box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset,rgba(44, 187, 99, .15) 0 1px 2px,rgba(44, 187, 99, .15) 0 2px 4px,rgba(44, 187, 99, .15) 0 4px 8px,rgba(44, 187, 99, .15) 0 8px 16px,rgba(44, 187, 99, .15) 0 16px 32px;
  color: green;
  cursor: pointer;
  display: inline-block;
  font-family: CerebriSans-Regular,-apple-system,system-ui,Roboto,sans-serif;
  padding: 7px 20px;
  text-align: center;
  text-decoration: none;
  transition: all 250ms;
  border: 0;
  font-size: 16px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-33:hover {
  box-shadow: rgba(44,187,99,.35) 0 -25px 18px -14px inset,rgba(44,187,99,.25) 0 1px 2px,rgba(44,187,99,.25) 0 2px 4px,rgba(44,187,99,.25) 0 4px 8px,rgba(44,187,99,.25) 0 8px 16px,rgba(44,187,99,.25) 0 16px 32px;
  transform: scale(1.05) rotate(-1deg);
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
                            <button class="button-33" type="submit">Rezerva</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>