<div class="field">
  <label class="label">Pick a Channel</label>
  <p class="control has-icons-left">
    <span class="select">
      <select name="channel">
        @foreach ($channels as $channel)
          <option value="{{$channel->id}}" {{isset($discussion) && $channel->id==$discussion->channel->id?'selected':''}}>{{$channel->title}}</option>
        @endforeach
      </select>
    </span>
    <span class="icon is-small is-left">
      <i class="fa fa-circle-o-notch"></i>
    </span>
  </p>
</div>

<div class="field">
  <label class="label">Provide a title</label>
  <div class="control has-icons-right">
    <input type="text" class="input {{$errors->has('title')?'is-danger':''}}" placeholder="Title here..." name="title" value="{{isset($discussion)?$discussion->title:""}}">
    @if ($errors->has('title'))
      <span class="icon is-small is-right">
        <i class="fa fa-exclamation-triangle"></i>
      </span>
    @endif
  </div>
    @if ($errors->has('title'))
      <p class="help is-danger">{{$errors->first('title')}}</p>
    @endif
</div>

<div class="field">
  <label class="label">Ask away</label>
  <div class="control">
    <textarea class="textarea {{$errors->has('description')?'is-danger':''}}" placeholder="What do you need help with? Be spcefic, so that your peers are better able ot assist you..." rows="8" name="description">{{isset($discussion)?$discussion->description:""}}</textarea>
  </div>
  @if ($errors->has('description'))
    <p class="help is-danger">{{$errors->first('description')}}</p>
  @endif
</div>
