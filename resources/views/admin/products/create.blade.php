@extends('layouts.admin_layout')

@section('title', 'Create product')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add product</h1>
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
            @endif
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product</h3>
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
                    <form action="{{route('products.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Product name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Author name</label>
                                <input type="text" class="form-control" id="author" name="author"
                                       placeholder="Enter author" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" min="0.01" class="form-control" id="price" name="price"
                                       placeholder="Enter price" required>
                            </div>
                            <div class="form-group">
                                <label for="image">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file-upload"><i class="fa fa-cloud-upload"></i>
                                            Upload Image</label>
                                        <input type="file" class="custom-file-input" id="file-upload" name="image"
                                               style="display:none;">
                                    </div>
                                </div>
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


