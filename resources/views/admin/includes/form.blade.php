<div class="field">
  <label class="label">Fullname</label>
  <div class="control has-icons-left has-icons-right">
    <input type="text" class="input {{$errors->has('name')?'is-danger':''}}" name="name" value="{{ old('name') }}" v-model="user.name">
    <span class="icon is-small is-left">
      <i class="fa fa-user"></i>
    </span>
    @if ($errors->has('name'))
      <span class="icon is-small is-right">
        <i class="fa fa-exclamation-triangle"></i>
      </span>
    @endif

  </div>
    @if ($errors->has('name'))
      <p class="help is-danger">{{$errors->first('name')}}</p>
    @endif
</div>

<div class="field">
  <label class="label">E-mail Address</label>
  <div class="control has-icons-left has-icons-right">
    <input type="email" class="input {{$errors->has('email')?'is-danger':''}}" name="email" value="{{ old('email') }}" v-model="user.email">
    <span class="icon is-small is-left">
      <i class="fa fa-envelope"></i>
    </span>
    @if ($errors->has('email'))
      <span class="icon is-small is-right">
        <i class="fa fa-exclamation-triangle"></i>
      </span>
    @endif

  </div>
    @if ($errors->has('email'))
      <p class="help is-danger">{{$errors->first('email')}}</p>
    @endif
</div>

<div class="field">
  <label class="label">Password</label>
  <div class="control has-icons-left has-icons-right">
    <input type="password" class="input {{$errors->has('password')?'is-danger':''}}" name="password" v-model="user.password">
    <span class="icon is-small is-left">
      <i class="fa fa-lock"></i>
    </span>
    @if ($errors->has('password'))
      <span class="icon is-small is-right">
        <i class="fa fa-exclamation-triangle"></i>
      </span>
    @endif
  </div>
  @if ($errors->has('password'))
    <p class="help is-danger">{{$errors->first('password')}}</p>
  @endif
</div>

<div class="field">
  <label class="label">Status</label>
  <b-switch type="is-success" name="active" v-model="user.active">Active</b-switch>
</div>
