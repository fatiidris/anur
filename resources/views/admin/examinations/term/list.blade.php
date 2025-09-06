@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Term List</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/examinations/term/add') }}" class="btn btn-primary">Add New Term</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            @include('_message')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Terms</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Term Name</th>
                                <th>Session</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getRecord as $index => $term)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $term->name }}</td>
                                    <td>{{ $term->session->name ?? 'N/A' }}</td>
                                    <td>{{ $term->creator->name ?? 'N/A' }}</td>
                                    <td>{{ $term->is_delete == 0 ? 'Active' : 'Deleted' }}</td>
                                    <td>
                                        <a href="{{ url('admin/examinations/term/edit/'.$term->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ url('admin/examinations/term/delete/'.$term->id) }}" method="post" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this term?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No terms found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
