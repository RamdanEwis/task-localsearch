@extends('layouts.app')
@section('css')

    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">

@endsection

@section('content')

    <div class="wrapper">
        <!-- Navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tasks</h1>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Tasks</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <a href="{{route('tasks.create')}}" class="btn btn-block btn-primary btn-lg offset-10 col-lg-2" style="margin-bottom: 10px">Create</a>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tasks</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th> title</th>
                                            <th>status</th>
                                            <th>due_date</th>
                                            <th>description</th>
                                            <th>actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{$task->title}}</td>
                                                <td style="color: @if($task->status === 'success') green @else #bfbf00 @endif" >{{$task->status}}</td>
                                                <td>{{$task->due_date}}</td>
                                                <td>{{$task->description}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success">Action</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu" style="">

                                                            <a href="{{ route('tasks.edit', $task) }}" class="dropdown-item px-3">
                                                                {{ __('Edit') }}
                                                            </a>
                                                            <a href="{{ route('tasks.status', $task) }}"
                                                               class="menu-link px-3">
                                                                {{ ($task->status == 'success') ? __('processing') :  __('success') }}
                                                            </a>
                                                            @if (auth()->user()->type ===  \App\Enum\UserType::SUPER_ADMIN->value)
                                                                <a class="dropdown-item px-3" href="{{ route('tasks.destroy', $task) }}"
                                                                   onclick="event.preventDefault();
                                                                         if (confirm('Are you sure you want to delete this customer?'))
                                                            document.getElementById('delete-form-{{ $task->id }}').submit();">
                                                                    {{ __('Delete') }}
                                                                </a>
                                                                <form id="delete-form-{{ $task->id }}"
                                                                      action="{{ route('tasks.destroy', $task) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->




@endsection


@section('js')
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
