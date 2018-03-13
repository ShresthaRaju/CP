@component('mail::message')

<h1>Welcome, {{$user->name}}</h1>

<p>Thanks for registering an account in the <b>Discussion Forum</b>. You are almost ready to get started.</p>
<p> Please verify your email, so we know it's really you. It's easy, just tap the button below :)</p>

@component('mail::button', ['url' => $url,'color'=>'green'])
Verify Your Email
@endcomponent

Regards,<br>
{{ config('app.name') }}
<hr>
<p style="font-size:12px">
  If you’re having trouble clicking the "Verify Your Email" button, copy and paste the URL below into your web browser: <br>
  <a href="{{$url}}">{{$url}}</a>
</p>
@endcomponent
