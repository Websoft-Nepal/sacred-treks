<x-mail::message>
    <div style="font-family: Arial, sans-serif;">
        <div style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px;">
            <div style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">Tour Booking Invoice</div>
            <div style="margin-bottom: 10px;">
                <label style="font-weight: bold;">First Name:</label> {{$trekkingBooking->firstName}}<br>
                <label style="font-weight: bold;">Last Name:</label> {{$trekkingBooking->lastName}}<br>
                <label style="font-weight: bold;">Trekking:</label> {{$trekkingBooking->trekking->title}}<br>
                <label style="font-weight: bold;">Email:</label> {{ $trekkingBooking->email }}<br>
                <label style="font-weight: bold;">No of Adults:</label> {{ $trekkingBooking->noOfAdults }}<br>
                <label style="font-weight: bold;">No of Children:</label> {{ $trekkingBooking->noOfChildren }}<br>
                <label style="font-weight: bold;">Contact Number:</label> {{ $trekkingBooking->number }}<br>
                <label style="font-weight: bold;">Address:</label> {{ $trekkingBooking->address }}<br>
                <label style="font-weight: bold;">Message:</label> {{ $trekkingBooking->message }}<br>
                <label style="font-weight: bold;">Cost:</label> {{ ($trekkingBooking->tour->cost * ($trekkingBooking->noOfAdults + $trekkingBooking->noOfChildren)) }}<br>
            </div>
        </div>

        <div>Thanks,<br>{{ config('app.name') }}</div>
    </div>
</x-mail::message>
