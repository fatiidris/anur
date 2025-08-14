@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Collect Fees</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
            <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Collect Fees Student</h3>
              </div>

              <!-- form start -->
              <form method="get"  action="" > 
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-2">
                    <label>Class</label>
                    <select class="form-control" name="class_id" id="">
                        <option value="">Select Class</option>
                        @foreach($getClass as $class)
                        <option {{ ( Request::get('class_id') == $class->id ) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group col-md-2">
                    <label>Student ID</label>
                    <input type="text" class="form-control" name="student_id" value="{{ Request::get('student_id') }}" placeholder="Student ID">
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label>Student First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ Request::get('first_name') }}" placeholder="Student First Name">
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label>Student Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ Request::get('last_name') }}" placeholder="Student Last Name">
                  </div>
                  
                   <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('admin/fees_collection/collect_fees')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                 </div>
                   </div>
                  </div>
              </form>
            </div>
          <!--/.col (right) -->

          @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Class Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Remaining Amount</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
               @if(!empty($getRecord))
                 @forelse($getRecord as $value)
                    @php
                       $paid_amount = $value->getPaidAmount($value->id, $value->class_id);
                       $RemainingAmount = $value->amount - $paid_amount;
                    @endphp
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }} {{ $value->last_name }}</td>
                    <td>{{ $value->class_name }}</td>
                    <td>₦{{ number_format($value->amount, 2) }}</td>
                    <td>₦{{ number_format($paid_amount, 2) }}</td>
                    <td>₦{{ number_format($RemainingAmount, 2) }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                    <td><a href="{{ url('admin/fees_collection/add_collect_fees/'.$value->id )}}" class="btn btn-success">Collect Fees</a></td>
                  </tr>
                 @empty
                    <tr>
                      <td colspan="100%">Record not Found</td>
                    </tr>
                 @endforelse
               @else
                    <tr>
                      <td colspan="100%">Record not Found</td>
                    </tr>
               @endif
              </tbody>
            </table>
               <div style="padding: 10px; float: right">
                 @if(!empty($getRecord))
                      {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                 @endif
                    </div>
              </div>


          </div>

        
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection