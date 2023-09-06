@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('Create Task')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('tasks.index')}}">Home</a></li>
                            <li class="breadcrumb-item active">Task Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="align-content-center offset-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tasks.store') }}">

                                @csrf

                                <div class="form-group">

                                    <label for="title">{{ __('title') }}</label>

                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ __('description') }}</label>

                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description"rows="4"></textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label for="status">Status</label><select name="status" id="status" class="form-control custom-select  @error('status') is-invalid @enderror" required>
                                        <option selected disabled>Select one</option>
                                        <option value="success">success</option>
                                        <option  value="processing">processing</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="due_date">{{ __('due_date') }}</label>
                                    <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" required autocomplete="due_date">

                                    @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                </div>

                                <div class="row mb-0">

                                    <div style="margin: 0 auto">
                                        <input type="submit" value="Create new Task" class="btn btn-success float-right">
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
