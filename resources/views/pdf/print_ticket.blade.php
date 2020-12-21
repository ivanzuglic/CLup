<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="width: 100%">

{{--{{ $appointment }}--}}
{{--{{ $qr }}--}}

<div style="width: 100%; text-align: center">
    <span style="font-size: large">Appointment ID:</span>
    <br>
    <span style="font-size: xx-large;">{{ $appointment->appointment_id }}</span>
    <br>
    <br>
    <div><img src="data:image/svg+xml;base64,{{base64_encode($qr)}}"></div>
    <br>
    <span>Estimated Time:&nbsp;<span style="font-size: x-large">{{ date('H:i', strtotime($appointment->start_time)) }}</span></span>
    <br>
    <div style="font-size: x-small; color: #555555;">*Actual entrance time may differ*</div>
</div>

</body>
</html>
