<!DOCTYPE html>
<html>
<head>
    <title>New Trekking Enquiry</title>
    <style>
        /* Inline CSS styles for email formatting */
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }
        .invoice-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .invoice-details {
            margin-bottom: 10px;
        }
        .invoice-details label {
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="invoice">
        <div class="invoice-header">Tour Enquiry</div>
        <div class="invoice-details">
            <label for="">Name: </label> {{$data->name}}<br>
            <label>Tour:</label> {{$data->tripPackage}}<br>
            <label>Email:</label> {{ $data->email }}<br>
            <label>Phone Number:</label> {{ $data->phoneNumber }}<br>
            <label>Start Date:</label> {{ $data->startDate }}<br>
            <label>End Date:</label> {{ $data->endDate }}<br>
            <label>Number of Travellers:</label> {{ $data->travellersNo }}<br>

        </div>
    </div>

    Thanks,<br>
    {{ config('app.name') }}
</body>
