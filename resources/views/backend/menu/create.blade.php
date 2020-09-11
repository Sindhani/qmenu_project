@extends('backend.layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('menu.index')}}">Menu</a></li>
                            <li class="breadcrumb-item active">Add Menu</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6 ">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add Menu</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!! Form::open(['route' => 'menu.store', 'enctype'=> 'multipart/form-data']) !!}
                                        <div class="form-group">
                                            <label for="categoryName">Menu</label>
                                            {!! Form::text('name', '',['class' => 'form-control', 'placeholder' => 'Enter Category Name', 'id' => 'categoryName']) !!}

                                        </div>
                                        <div class="form-group">
                                            <label for="categoryName">Priority</label>
                                            {!! Form::number('priority' ,'', ['class' => 'form-control'])!!}
                                        </div>
                                        <!-- radio -->
                                        {!! Form::open(['route' => 'category.store']) !!}
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio('language', 'english', true, ['class'=>'custom-control-input', 'id' => 'englishRadio']) !!}
                                                <label for="englishRadio" class="custom-control-label">English</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                {!! Form::radio('language', 'arabic', false, ['class'=>'custom-control-input', 'id' => 'arabicRadio']) !!}
                                                <label for="arabicRadio" class="custom-control-label">Arabic</label>
                                            </div>
                                        </div>



                                        <!-- <label for="customFile">Custom File</label> -->
                                        <div class="custom-file ">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="menu">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info px-5">Save</button>
                                <button type="reset" class="btn btn-default float-right">Cancel</button>
                                <button type="reset" class="btn btn-info float-right mr-2" onclick="window.history.back();"><i class="fas fa-arrow-alt-circle-left px-2 " ></i>Go Back</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </div>
    </div>


@stop