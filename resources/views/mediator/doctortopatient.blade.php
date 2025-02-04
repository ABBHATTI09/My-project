<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status Update</title>
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
            <h2>Appointment Status Update</h2>
        </div>

        <div class="content">
            <p>Dear <span class="highlight">{{$data['patient_name']}}</span>,</p>

            <p>Dr. <span class="highlight">{{$data['doctor_name']}}</span> has updated the status of your appointment. Below are the details:</p>

            <p><strong>Appointment Date:</strong> <span class="highlight">{{$data['appointment_date']}}</span></p>
            <p><strong>Appointment Time:</strong> <span class="highlight">{{ date('h:i A', strtotime($data['appointment_time'])) }}</span></p>
            <p><strong>Booking Type:</strong> <span class="highlight">
                @if($data['booking_type']==1)
                    Normal Booking Appointment
                @else
                    Emergency Booking Appointment
                @endif
            </span></p>

            <p><strong>Appointment Status:</strong> <span class="highlight">
                @if($data['doctor_status']==1)
                    Completed
                @else
                    Not Completed
                @endif
            </span></p>

            <p>For any further assistance, please feel free to contact us.</p>
        </div>
    </div>

</body>
</html>
