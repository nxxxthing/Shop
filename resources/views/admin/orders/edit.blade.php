@extends('layouts.admin_layout')

@section('title', 'Edit order')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit order {{$order['name']}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
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
                        <h3 class="card-title">Edit User</h3>
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
                    <form action="{{route('orders.update', $order)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->getKey() }}"
                                                @if($user->getKey() == $order->user_id) selected @endif> {{ $user->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach($products as $product)
                                        <option value="{{ $product->getKey() }}"
                                                @if($product->getKey() == $order->product_id) selected @endif> {{ $product->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" min="1" step="1" id="amount" name="amount" class="form-control"
                                       value="{{$order->amount}}" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


