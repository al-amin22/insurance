@component('mail::message')
# New Contact Form Submission

**Name:** {{ $data['name'] }}
**Email:** {{ $data['email'] }}
**Subject:** {{ $data['subject'] }}

**Message:**
{{ $data['message'] }}

@component('mail::button', ['url' => 'mailto:'.$data['email']])
Reply to {{ $data['name'] }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
