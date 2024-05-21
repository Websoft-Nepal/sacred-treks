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
        <div class="invoice-header">Contact Mail</div>
        {{$contactUs->name }} has messaged you.<br>
        <div class="invoice-details">
            <label for="">Name: </label> {{$contactUs->name}}<br>
            <label>Email:</label> {{$contactUs->email}}<br>
            <label>Phone Number:</label> {{$contactUs->number}}<br>
            <label>Message :</label> {{$contactUs->message}}<br>
        </div>
    </div>

    Thanks,<br>
    {{ config('app.name') }}
</body>

