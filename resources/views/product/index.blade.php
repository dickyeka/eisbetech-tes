@extends('adminlte::page')

@section('css')
    <meta name="token" id="token" value="{{ csrf_token() }}">
@stop

@section('title', 'Product ')

@section('content_header')
    <h1> Product</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6 ">
            <a href="{{route('product.create')}}" class="btn btn-info">Create</a>
        </div>
    </div>
    <br><br>
    <div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-7">
                <form role="search">
                    <div class="input-group">
                        <input type="text" value="" name="name" class="form-control">
                        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Cari Data</button>
          </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Product</h3>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stok</th>
                        <th style="width:200px;">Action</th>
                    </tr>
                    @forelse($products as $product)
                        <tr>
                            <td><img src="{{$product->image}}" class="img-responsive" alt="Image" width="150px"></td>
                            <td>{{$product->name}} </td>
                            <td>{{$product->category->name}} </td>
                            <td>{{$product->price}} </td>
                            <td>{{$product->stok}} </td>
                            <td>
                                <a href="{{route('product.show',$product->id)}}" class="btn btn-primary">View</a>
                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-success">Edit</a>
                                <a onclick="checkDelete({{$product->id}})"  class="btn btn-danger" ><i class="fa fa-trash-o"></i> </a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="6">No Data</td>
                    @endforelse
                </table>
                <div class="box-footer clearfix">
                    {!! $paginate !!}
                </div>
            </div>



        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        function checkDelete(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
                }
            });
            if (confirm('Really delete?')) {
                $.ajax({
                    url:" {{ url('product')}}/"+id,
                    type: 'DELETE',
                })
                .done(function(res) {
                    location.reload();
                })
            }
        }
    </script>
@stop
