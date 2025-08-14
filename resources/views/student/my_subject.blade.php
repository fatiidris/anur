@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Subject</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
            
          @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Subject</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Subject Name</th>
                      <th>Subject Type</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($getRecord as $value)

                  <tr>
                    <td>{{ $value->subject_name }}</td>
                    <td>{{ $value->subject_type }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                      
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