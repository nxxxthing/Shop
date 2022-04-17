@extends('layouts.admin_layout')

@section('title', __('messages.order'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.order')}} {{$order->getKey()}}</h1>
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
            @endif
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">
                        id
                    </th>
                    <th style="width: 1%">
                        {{__('messages.user')}}
                    </th>
                    <th style="width: 1%">
                        {{__('messages.product')}}
                    </th>
                    <th style="width: 3%">
                        {{__('messages.amount')}}
                    </th>
                    <th style="width: 3%">
                        {{__('messages.price')}}
                    </th>
                    <th style="width: 3%">
                        {{__('messages.status')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{$order->getKey()}}
                        </td>
                        <td>
                            {{$user_name}}
                        </td>
                        <td>
                            {{$product_name}}
                        </td>
                        <td>
                            {{$order->amount}}
                        </td>
                        <td>
                            {{$order->price}}
                        </td>
                        <td>
                            {{$status}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


