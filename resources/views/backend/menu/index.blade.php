@extends('backend.layout.app')
@section('css')
    <style>
        .addCategory:hover {
            color: #3268a7 !important;
        }
    </style>
@stop
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Menu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories Table</h3>
                                <a href="{{route('menu.create')}}"><i
                                            class="fas fa-plus-circle text-success float-right fa-2x addCategory"></i>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Priority</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menus as $menu)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$menu->name}}</td>
                                            <td>{{$menu->priority}}</td>

                                            @foreach($menu->images as $image)
                                                <td>
                                                    <img src="{{asset('/images/').'/'.$image->image}}" width="150" height="30px" class="img-fluid">
                                                </td>
                                            @endforeach
                                            <td>{{$menu->category_id}}</td>
                                            <td>{{$menu->created_at}}</td>
                                            <td>
                                                {!! Form::open(['route' => ['menu.destroy', $menu->id], 'method' => 'delete', 'style' => 'display:inline-block;', 'class' => 'p-0 m-0']) !!}
                                                <button type="button"  style="border: none!important; display: inline;" class="float-left"><a href="{{route('menu.edit', $menu->id)}}"><i class="fas fa-pencil-alt text-success mr-2"></i> </a></button>
                                                <button type="submit" style="border: none!important; display: inline;"
                                                        class="float-right"><i class="fas fa-trash text-danger"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>


@stop
@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": true,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>
@endsection