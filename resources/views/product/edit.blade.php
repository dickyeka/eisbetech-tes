@extends('adminlte::page')

@section('title', 'Product - Update')

@section('content_header')
    <h1>Product</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Product</h3>
            </div>
            <div class="box-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada inputan yang salah.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($product,['route'=>['product.update',$product->id],'method'=>'PATCH','files'=>'true']) !!}

                <div class="form-group">
                    <label for="">Name</label>
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    {!! Form::select('category_id', $categories,null,['class'=>'category form-control ']) !!}
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Stok</label>
                        {!! Form::number('stok',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="">Price</label>
                        {!! Form::number('price',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    {!! Form::textarea('description',null,['class'=>'form-control','id'=>'editor1']) !!}
                </div>

                <div class="form-group">
                    <label style="margin-bottom: 8px;" for="">Image</label>
                    {!! Form::file('file', ['class'=>'form-control','id'=>'inputgambar','style'=>'width:200px;']) !!}
                    <br>
                    <img src="{{$product->image}}" id="showgambar" style="width:200px;"/>
                </div>

                <div class="form-group">
                    <label for="">Color</label>
                    {!! Form::select('color[]', $colors,null,['class'=>'category form-control select2-multi color','multiple'=>'multiple']) !!}
                </div>
                <div class="form-group">
                    <label for="">Tag</label>
                    {!! Form::select('tag[]', $tags,null,['class'=>'category form-control select2-multi tag','multiple'=>'multiple']) !!}
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ URL::previous() }}" class="btn btn-warning" style="padding: 6px 20px;">Back</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script type="text/javascript">
            $(".category").select2();
            $('.tag').select2().val({{ json_encode($product->tags->pluck('id')) }}).trigger('change');
            $('.color').select2().val({{ json_encode($product->colors->pluck('id')) }}).trigger('change');
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#showgambar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#inputgambar").change(function () {
                readURL(this);
            });


        </script>
@stop
