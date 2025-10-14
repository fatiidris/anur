@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @include('_message')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form method="post"  action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Paystack Business Email</label>
                    <input type="email" class="form-control" name="paystack_email" value= "{{ $getRecord->paystack_email }}" required placeholder="Paystack Business Email">
                  </div>

                  <div class="form-group">
                    <label>Paystack Public Key</label>
                    <input type="text" class="form-control" name="paystack_key" value= "{{ $getRecord->paystack_key }}">
                  </div>

                  <div class="form-group">
                    <label>Paystack Secret Key</label>
                    <input type="text" class="form-control" name="paystack_secret" value= "{{ $getRecord->paystack_secret }}">
                  </div>
                   <div class="form-group">
                    <label>Logo<span style="color: red;"></span></label>
                    <input type="file" class="form-control" name="logo">
                    <div style="color: red"> {{ $errors->first('logo')}} </div>
                    @if(!empty($getRecord->getLogo()))
                    <img src="{{ $getRecord->getLogo() }}" style="width: auto;height: 50px;" alt="">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Fevicon Icon<span style="color: red;"></span></label>
                    <input type="file" class="form-control" name="fevicon_icon">
                    <div style="color: red"> {{ $errors->first('fevicon_icon')}} </div>
                    @if(!empty($getRecord->getFevicon()))
                    <img src="{{ $getRecord->getFevicon() }}" style="width: auto;height: 50px;" alt="">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Principal Signature<span style="color: red;"></span></label>
                    <input type="file" class="form-control" name="principal_signature">
                    <div style="color: red"> {{ $errors->first('principal_signature')}} </div>
                    @if(!empty($getRecord->getPrincipalSign()))
                    <img src="{{ $getRecord->getPrincipalSign() }}" style="width: auto;height: 50px;" alt="">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>School Name</label>
                    <input type="text" class="form-control" name="school_name" value= "{{ $getRecord->school_name }}">
                  </div>

                  <div class="form-group">
                     <label>Exam Description</label>
                     <textarea name="exam_description" class="form-control">{{ $getRecord->exam_description }}</textarea>
                  </div>
                  <div class="form-group">
                     <label>Next Term Begins</label>
                     <input type="date" name="next_term_begin" class="form-control" value="{{ $getRecord->next_term_begin }}">
                  </div>
                  <div class="form-group">
                     <label>Term End</label>
                     <input type="date" name="term_end" class="form-control" value="{{ $getRecord->term_end }}">
                  </div>

                 <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
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
  @endsection