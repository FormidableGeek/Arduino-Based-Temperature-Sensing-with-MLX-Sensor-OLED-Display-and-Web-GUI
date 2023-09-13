@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
Dear {{ auth()->user()->name}}
, your last thermometer reading was {{$contact->reading}} °C as at {{ date("h:i:sa")}} {{date("d")}} th {{date("D. M., Y")}} .
<p>From, <br>
Group 2 mechatronics Infrared thermometer
</p>


{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
