@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Term</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/examinations/term/list') }}" class="btn btn-secondary">Back to Term List</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form method="post" action="">
                            @csrf
                            <div class="card-body">
                                @include('_message')

                                <div class="form-group">
                                    <label>Session</label>
                                    <select name="session_id" class="form-control" required>
                                        <option value="">-- Select Session --</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Term Name</label>
                                    <select name="name" class="form-control" required>
                                        <option value="">-- Select Term --</option>
                                        <option value="First Term">First Term</option>
                                        <option value="Second Term">Second Term</option>
                                        <option value="Third Term">Third Term</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
