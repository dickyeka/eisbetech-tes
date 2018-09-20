@extends('adminlte::page')

@section('title', 'Product - show')

@section('content_header')
    <h1>Product Detail</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary">

            <div class="box-body">
                <img src="{{$product->image}}" class="img-responsive" alt="Image">
                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <td >Name</td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>{{ $product->stok }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td>
                            @foreach($product->colors  as $color)
                                <span class="label label-info">{{$color->name}}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Tag</td>
                        <td>
                            @foreach($product->tags  as $tag)
                                <span class="label label-info">{{$tag->name}}</span>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @stop