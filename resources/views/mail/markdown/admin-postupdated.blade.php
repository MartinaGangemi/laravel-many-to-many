@component('mail::message')
# Introduction

Ciao, il post {{$postSlug}} è stato modificato.

@component('mail::button', ['url' => '$postUrl'])
Review post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
