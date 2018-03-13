@extends('layouts.admin')

@section('title','Create New User')

@section('main_content')
  <div class="columns is-mobile">
    <div class="column">
      <nav class="breadcrumb has-arrow-separator" aria-label="breadcrumbs">
        <ul>
          <li><a href="{{route('admin.dashboard')}}"><span class="icon"><i class="fa fa-dashboard"></i></span></a></li>
          <li><a href="{{route('admin.users.index')}}">Users</a></li>
          <li class="is-active"><a aria-current="page">Create new user</a></li>
        </ul>
      </nav>
    </div>

    <div class="column">
      <a href="{{route('admin.users.index')}}" class="button is-primary is-pulled-right m-t-10"><span class="icon"><i class="fa fa-user-plus"></i></span><span>View All Users</span></a>
    </div>
  </div>

  <hr>

  <div class="columns">
    <div class="column is-4 is-offset-4">
      <div class="card">
        <div class="card-content">
          {{-- {!!Form::open(['@submit.prevent="createNewUser"'])!!}
            @include('admin.includes.form')
            <button type="submit" class="button is-primary is-fullwidth">Create</button>
          {!!Form::close()!!} --}}
          <form method="post" action="{{route('admin.users.store')}}">
            @csrf
            @include('admin.includes.form')
            <button type="submit" class="button is-primary is-fullwidth">Create</button>
          </form>
        </div>
      </div> <!--- end of .card-->
    </div>
  </div>
@endsection

@section('scripts')
<script>

var app=new Vue({
  el:'#app',
  data:{
    uri:'{{route('admin.users.store')}}',
    user:{
      name:'',
      email:'',
      password:'',
      active:''
    }
  },
  methods:{
    createNewUser(){
      axios.post(this.uri,this.user)
      .then((response) => {
        console.log(response.data.redirect);
        window.location.href = response.data.redirect;
                this.$toast.open({
                  duration:3000,
                  message:response.data.message,
                  type:'is-success'
                });
              })
              .catch(function (error){
                console.log(error);
              })
    }
  },
});
</script>

@endsection
