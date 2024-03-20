<x-mail::message>
# Hello Admin,

{{$contactUs->name }} has messaged you.<br>
Email : {{$contactUs->email}}<br>
Number : {{$contactUs->number}}<br>
Message : {{$contactUs->message}}


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
