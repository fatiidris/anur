@extends('layouts.app')
@section('style')

<style> 
    .select2-container .select2-selection--single
    {
        height: 40px;
    }

</style>
@endsection
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Homework</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          @include('_message')
            <div class="card card-primary">
              <!-- form start -->
              <form method="post"  action="{{ url('teacher/homework/homework/add') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Class <span style="color: red;">*</span></label>
                    <select class="form-control" id="getClass" name="class_id" required>
                        <option value="">Select Class</option>
                        @foreach($getClass as $class)
                        <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Subject<span style="color: red;">*</span></label>
                    <select class="form-control" name="subject_id" id="getSubject" required>
                        <option value="">Select Subject</option>
                        @foreach($getSubject as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Homework Date<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" name="homework_date" value="{{ Request::get('homework_date') }}" placeholder="" required>
                    </div>
                    <div class="form-group">
                    <label>Submission Date<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" name="submission_date" value="{{ Request::get('submission_date') }}" placeholder="" required>
                    </div>
                    <div class="form-group">
                    <label>Document</label>
                    <input type="file" class="form-control" name="document_file" value="{{ Request::get('document_file') }}" placeholder="">
                    </div>
                  <div class="form-group">
                    <label>Description<span style="color: red;">*</span></label>
                    <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">               
                    </textarea>
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

  @section('script')
    
    <script src="{{ url ('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
    
    <script type="text/javascript">

          $(function () {
         
          $('#compose-textarea').summernote({
                  height: 200
                  });
          $('getClass').change(function () {
                var class_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('teacher/ajax_get_subject') }}",
                    data : {
                    "_token": "{{ csrf_token() }}", 
                    class_id : class_id,
                    
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#getSubject').html(data.success);
                        
                    // alert(data.message);

                    }
             });
           }); 
          });

    </script>
  @endsection  
