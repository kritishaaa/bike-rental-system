<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Rental Confirmation</title>
</head>
<body>
    <h1>Hello, {{ $userName }}!</h1>
    <p>Your bike rental has been successfully confirmed.</p>
    <p>Bike Name: <strong>{{ $bikeName }}</strong></p>
    <p>Please return the bike by <strong>{{ $toDate }}</strong>. If the bike is not returned by this date, additional charges will be applied.</p>
    <p>Thank you for choosing our service! We hope you enjoy your ride!</p>
    <br>
    <p>Warm regards,</p>
    <p>The RideFlex Team</p>
</body>
</html>
