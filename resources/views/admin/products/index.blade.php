@extends('layouts.admin_layout')

@section('title', 'All products')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
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
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">
                        id
                    </th>
                    <th style="width: 20%">
                        name
                    </th>
                    <th style="width: 8%">
                        author
                    </th>
                    <th>
                        price
                    </th>
                    <th style="width: 30%" class="text-center">
                        book cover
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        {{$product->getKey()}}
                    </td>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->author}}
                    </td>
                    <td class="project_progress">
                        {{$product->price}}
                    </td>
                    <td class="project-state">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <img style="max-width: 80px; max-height: 80px;" src="{{ url('/storage/img/'.$product->image_name) }}">
                            </li>

                        </ul>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="#">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm" href="#">
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


