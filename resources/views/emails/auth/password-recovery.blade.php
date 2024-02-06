@component('mail::message')
{{__('Password recovery')}}

{{__('Code')}} : <h4>{{$activation_code}}</h4>

{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent