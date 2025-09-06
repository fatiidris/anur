@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Exam</h1>
                </div>
            </div>
        </div>
    </section>

    @include('_message')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form method="post" action="">
                            @csrf
                            <div class="card-body">
                                <!-- Session Dropdown -->
                                <div class="form-group">
                                    <label>Session</label>
                                    <select name="session_id" id="session_id" class="form-control" required>
                                        <option value="">-- Select Session --</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}"
                                                {{ old('session_id', $getRecord->session_id) == $session->id ? 'selected' : '' }}>
                                                {{ $session->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Term Dropdown -->
                                <div class="form-group">
                                    <label>Term</label>
                                    <select name="term_id" id="term_id" class="form-control" required>
                                        <option value="">-- Select Term --</option>
                                        @foreach($terms as $term)
                                            <option value="{{ $term->id }}"
                                                {{ old('term_id', $getRecord->term_id) == $term->id ? 'selected' : '' }}>
                                                {{ $term->name }} ({{ $term->session->name ?? 'No Session' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Exam Name (Auto-generated) -->
                                <div class="form-group">
                                    <label>Exam Name</label>
                                    <input type="text" class="form-control" name="name" id="exam_name"
                                        value="{{ old('name', $getRecord->name) }}" readonly required>
                                </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    const sessionSelect = document.getElementById('session_id');
    const termSelect = document.getElementById('term_id');
    const examNameInput = document.getElementById('exam_name'); // FIXED: should match the input ID

    function updateExamName() {
        const sessionText = sessionSelect.options[sessionSelect.selectedIndex]?.text || '';
        const termText = termSelect.options[termSelect.selectedIndex]?.text.split(' (')[0] || ''; // Extract term name only
        examNameInput.value = (termText && sessionText) ? `${termText}, ${sessionText}` : '';
    }

    sessionSelect.addEventListener('change', updateExamName);
    termSelect.addEventListener('change', updateExamName);

    // Initialize on page load if already selected (for Edit page)
    updateExamName();
 });
</script>

@endsection
