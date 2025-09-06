@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam List (Total : {{ $getRecord->total() }})</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/examinations/exam/add') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add New Exam
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Search Exam</h3>
        </div>
        <form method="get" action="">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Exam Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Exam Name">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Session</label>
                        <select name="session_id" class="form-control">
                            <option value="">-- Select Session --</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}" {{ Request::get('session_id') == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Term</label>
                        <select name="term_id" class="form-control">
                            <option value="">-- Select Term --</option>
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}" {{ Request::get('term_id') == $term->id ? 'selected' : '' }}>
                                    {{ $term->name }} ({{ $term->session->name ?? 'No Session' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" style="margin-top: 30px;">
                        <button class="btn btn-primary" type="submit">Search</button>
                        <a href="{{ url('admin/examinations/exam/list') }}" class="btn btn-success">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('_message')

    <!-- Exam List Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Exam List</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Exam Name</th>
                        <th>Session</th>
                        <th>Term</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->session->name ?? 'N/A' }}</td>
                            <td>{{ $value->term->name ?? 'N/A' }}</td>
                            <td>{{ $value->creator->name ?? 'N/A' }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                                <a href="{{ url('admin/examinations/exam/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ url('admin/examinations/exam/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="padding: 10px; float: right;">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

@endsection
