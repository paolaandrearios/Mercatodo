@component('mail::message')
# {{ __('general.web.hello') }}

{{ __('general.web.data_management.error_email_description', ['fileName'=> $importFile]) }}
@component("mail::table")
| {{ __('general.web.errors') }}   |
| --------- |
@foreach($errors as $error)
@foreach($error as $message)
| {{ $message }}     |
@endforeach
@endforeach
@endcomponent

{{-- Action Button --}}
@isset($actionText)

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
{{ $actionText }}
@endcomponent
@endisset

{{ __('general.web.thanks_use_application') }}


{{ __('general.web.regards') }},
{{ __('general.web.mercatodo') }}

@endcomponent



