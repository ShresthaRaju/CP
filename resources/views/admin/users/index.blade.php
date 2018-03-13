@extends('layouts.admin')

@section('title',"All Users")

@section('main_content')
<div class="columns is-mobile">
  <div class="column">
    <nav class="breadcrumb has-arrow-separator" aria-label="breadcrumbs">
      <ul>
        <li><a href="{{route('admin.dashboard')}}"><span class="icon"><i class="fa fa-dashboard"></i></span></a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li class="is-active"><a aria-current="page">All Users</a></li>
      </ul>
    </nav>
  </div>

  <div class="column">
    <a href="{{route('admin.users.create')}}" class="button is-primary is-pulled-right m-t-10"><span class="icon"><i class="fa fa-user-plus"></i></span><span>Create New User</span></a>
  </div>
</div>

<hr>

<div class="columns">
  <div class="column is-10 is-offset-1">
    <div class="card">
      <div class="card-content">
        <table class="table is-striped is-hoverable is-narrow is-fullwidth">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>E-mail</th>
              <th>Date Joined</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->updated_at->toFormattedDateString()}}</td>
                <td>{!!$user->active==1?'<span class="tag is-info">Active</span>':'<span class="tag is-danger">Inactive</span>'!!}</td>
                <td>
                  <a class="has-text-grey"><span class="icon"><i class="fa fa-eye"></i></span></a>
                  <a class="is-pulled-right has-text-danger" data-user-id="{{$user->id}}" @click.prevent="deleteUser" id="delete-user"><span class="icon"><i class="fa fa-trash"></i></span></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!--- end of .card-->
    {{$users->links('vendor.pagination.default')}}
  </div>
</div>
@endsection

@section('scripts')
<script>
  var app=new Vue({
    el:'#app',
    data:{

    },
    methods: {
      // getAllUsers(){
      //   axios.get('/all')
      //         .then((response) => {
      //           this.users=response.data.data
      //           console.log(response);
      //           alert('done');
      //           console.log(this.users);
      //           // console.log(response.data);
      //         })
      //         .catch(function (error){
      //           console.log(error);
      //         });
      // },

      deleteUser(){
        this.$dialog.confirm({
                    title: 'Deleting User',
                    message: 'Are you sure you want to <b>delete</b> this user? This action cannot be undone.',
                    confirmText: 'Delete User',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => axios.delete(`users/${34}`)
                    .then((response) => {
                              this.$toast.open({
                                duration:3000,
                                message:response.data.message,                          
                              });
                            })
                            .catch(function (error){
                              console.log(error);
                            })
                  });
      }
    }
  });
</script>
@endsection
