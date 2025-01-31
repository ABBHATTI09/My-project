<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            color: #333;
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        .content p {
            margin: 10px 0;
        }
        .content .highlight {
            font-weight: bold;
            color: #333;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Appointment Booking Confirmation</h2>
        </div>

        <div class="content">
            <p>Dear Dr. <span class="highlight">{{$data['doctor_name']}}</span>,</p>

            <p>We would like to inform you that an appointment has been booked with you by <span class="highlight">{{$data['patient_name']}}</span>. Here are the details of the appointment:</p>
            @if($data['booking_type']==1)
            <p><strong>Appointment Date:</strong> <span class="highlight">{{$data['appointment_date']}}</span></p>
            <p><strong>Appointment Time:</strong> <span class="highlight">{{ date('h:i A', strtotime($data['appointment_time'])) }}</span></p>
            <p><strong>Booking Type:</strong> <span class="highlight">Normal Booking Appointment</span></p>
            <p><strong>Booking Status:</strong> <span class="highlight">Pending</span></p>

            @else
            <p><strong>Booking Type:</strong> <span class="highlight">Emergency Booking Appointment</span></p>
            <p><strong>Booking Status:</strong> <span class="highlight">Pending</span></p>
            @endif

            <p>If you have any questions or need to reschedule, please let us know.</p>

            <p>Please update the status of the appointment.</p>
        </div>
    </div>

</body>
</html>
