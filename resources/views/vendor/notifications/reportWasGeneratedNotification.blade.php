@component('mail::message')
# {{ __('general.web.hello') }}

{{ __('general.web.data_management.success_report_email_description', ['fileName'=> $reportFile]) }}

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



