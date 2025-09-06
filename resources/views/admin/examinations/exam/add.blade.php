@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Exam</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/examinations/exam/list') }}" class="btn btn-secondary">Back to Exams</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                       <form method="post" action="{{ url('admin/examinations/exam/add') }}">
                            @csrf
                            <div class="card-body">
                                @include('_message')

                                <div class="form-group">
                                    <label>Session</label>
                                    <select name="session_id" id="session_id" class="form-control" required>
                                        <option value="">-- Select Session --</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Term</label>
                                    <select name="term_id" id="term_id" class="form-control" required>
                                        <option value="">-- Select Term --</option>
                                        @foreach($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Exam Name</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="is_delete" class="form-control">
                                        <option value="0" selected>Active</option>
                                        <option value="1">Deleted</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- Auto-generate Exam Name -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sessionSelect = document.getElementById('session_id');
    const termSelect = document.getElementById('term_id');
    const examNameInput = document.getElementById('name'); // Must match your input name attribute

    function updateExamName() {
        const sessionText = sessionSelect.options[sessionSelect.selectedIndex]?.text || '';
        const termText = termSelect.options[termSelect.selectedIndex]?.text || '';
        examNameInput.value = (sessionText && termText) ? `${termText}, ${sessionText}` : '';
    }

    sessionSelect.addEventListener('change', updateExamName);
    termSelect.addEventListener('change', updateExamName);

    // Initialize on page load if already selected (for Edit page)
    updateExamName();
});
</script>

@endsection
