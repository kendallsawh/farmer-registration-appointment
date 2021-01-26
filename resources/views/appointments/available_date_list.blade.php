@foreach($available_dates as $date)
<input type="radio" id="appoint-date-{{$loop->index}}" name="appointment_date" value="{{$date->appointment_date}}">
<label for="appoint-date-{{$loop->index}}">Date option {{$loop->iteration}}: {{$date->appointment_date}}</label><br>
@endforeach