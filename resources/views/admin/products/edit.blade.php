@extends('layouts.admin_layout')

@section('title', __('messages.edit_product'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.edit_product')}} {{$product['name']}}</h1>
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
                        <h3 class="card-title">{{__('messages.edit_product')}}</h3>
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
                    <form action="{{route('products.update', $product)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('messages.name_for_product')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{$product['name']}}" required>
                            </div>
                            <div class="form-group">
                                <label for="author">{{__('messages.author')}}</label>
                                <input type="text" class="form-control" id="author" name="author"
                                       value="{{$product['author']}}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('messages.price')}}</label>
                                <input type="number" step="0.01" min="0.01" class="form-control" id="price" name="price"
                                       value="{{$product['price']}}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('messages.cover')}}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file-upload"  ><i class="fa fa-cloud-upload"></i>
                                            {{$product['image_name']}}</label>
                                        <input type="file" class="custom-file-input" id="file-upload" name="image"
                                               style="display:none;">
                                        <input type="hidden" id="secret" name="secret" value="{{ $product['image_name'] }}">
                                    </div>
                                </div>
                                <button class="brn btn-secondary" type="button" onclick="resetImage()">{{__('messages.delete')}}</button>
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


