@component('mail::message')

# New Contact Submission
{{ config('app.url') }}

Name: {{ $contact_submission->name }} <br>
Email: {{ $contact_submission->email }} <br>
Message: {{ $contact_submission->message }} <br>

@endcomponent
