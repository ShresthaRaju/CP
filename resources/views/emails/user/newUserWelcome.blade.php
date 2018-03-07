@component('mail::message')

<h1>Welcome, {{$user->name}}</h1>

<p>Thanks for signing up in the <b>Discussion Forum</b>. You will be posting on it in seconds.</p>
<p> We just need you to verify your account. :)</p>

@component('mail::button', ['url' => $url,'color'=>'green'])
Verify Your Account
@endcomponent

Regards,<br>
{{ config('app.name') }}
<hr>
<p style="font-size:12px">
  If you’re having trouble clicking the "Verify Your Account" button, copy and paste the URL below into your web browser: <br>
  <a href="{{$url}}">{{$url}}</a>
</p>
@endcomponent
