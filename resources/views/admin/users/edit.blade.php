@extends('layouts.admin_layout')

@section('title', __('messages.edit_user'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.edit_user')}} {{$user['name']}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item">
                            <select class="changeLang">
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="ua" {{ session()->get('locale') == 'ua' ? 'selected' : '' }}>Українська</option>
                            </select>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-check"></i> {{session('message')}}</h4>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-exclamation-circle"></i> {{session('error')}}</h4>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('messages.edit_user')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <!-- form start -->
                    <form action="{{route('users.update', $user)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('messages.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter name" value="{{$user->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('messages.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter email" value="{{$user->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">{{__('messages.password')}}</label>
                                <input type="text" minlength="6" class="form-control" id="password" name="password"
                                       placeholder="Enter password" value="{{$user->password}}" required>
                            </div>
                            <div class="form-group">
                                <label for="role">{{__('messages.role')}}</label>
                                @if($user->roles->first()->name != 'super-admin')
                                    <select name="role" id="role" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}"
                                                    @if($user->roles->first()->name == $role->name) selected @endif> {{ $role->name }} </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="role" id="role" class="form-control" disabled>
                                        <option value="super-admin" selected>super-admin</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{__('messages.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


