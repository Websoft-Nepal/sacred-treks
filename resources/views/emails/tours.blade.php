<x-mail::message>
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

    <div class="invoice">
        <div class="invoice-header">Tour Booking Invoice</div>
        <div class="invoice-details">
            <label>First Name:</label> {{$tourBooking->firstName}}<br>
            <label>Last Name:</label> {{$tourBooking->lastName}}<br>
            <label>Tour:</label> {{$tourBooking->tour->title}}<br>
            <label>Email:</label> {{ $tourBooking->email }}<br>
            <label>No of Adults:</label> {{ $tourBooking->noOfAdults }}<br>
            <label>No of Children:</label> {{ $tourBooking->noOfChildren }}<br>
            <label>Contact Number:</label> {{ $tourBooking->number }}<br>
            <label>Address:</label> {{ $tourBooking->address }}<br>
            <label>Message:</label> {{ $tourBooking->message }}<br>
            <label>Cost:</label> {{ ($tourBooking->tour->cost * ($tourBooking->noOfAdults + $tourBooking->noOfChildren)) }}<br>
        </div>
    </div>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
