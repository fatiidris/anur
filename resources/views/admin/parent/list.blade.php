@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent List (Total : {{ $getRecord->total()}})</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{url('admin/parent/add')}}" class="btn btn-primary">Add New Parent</a>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Search Parent</h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Name">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Last Name</label>
                      <input type="text" class="form-control" name="last_name" value="{{ Request::get('last_name') }}" placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Email</label>
                      <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Gender</label>
                      <select class="form-control" name="gender">
                        <option value="">Select Gender</option>
                        <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                        <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Occupation</label>
                      <input type="text" class="form-control" name="occupation" value="{{ Request::get('occupation') }}" placeholder="Occupation">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control" name="mobile_number" value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                    </div>
                    <div class="form-group col-md-3 mt-4">
                      <button class="btn btn-primary" type="submit">Search</button>
                      <a href="{{ url('admin/parent/list')}}" class="btn btn-success">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Parent List</h3>
                <form action="{{ url('admin/parent/export_excel') }}" method="post" style="float: right;">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ Request::get('name')}}" name="name">
                        <input type="hidden" value="{{ Request::get('last_name')}}" name="last_name">
                        <input type="hidden" value="{{ Request::get('email')}}" name="email">
                        <input type="hidden" value="{{ Request::get('gender')}}" name="gender">
                        <input type="hidden" value="{{ Request::get('occupation')}}" name="occupation">
                        <input type="hidden" value="{{ Request::get('address')}}" name="address">
                        <input type="hidden" value="{{ Request::get('mobile_number')}}" name="mobile_number">
                        <input type="hidden" value="{{ Request::get('status')}}" name="status">
                        <input type="hidden" value="{{ Request::get('date')}}" name="date">
                      <button type="submit" class="btn btn-primary">Export Excel</button>
                </form>

              </div>
              <div class="card-body table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profile Pic</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Mobile Number</th>
                      <th>Occupation</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Created Date</th>
                      <th style="min-width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>
                        @if(!empty($value->getProfileDirect()))
                          <img src="{{ $value->getProfileDirect() }}" class="rounded-circle" style="height: 50px; width: 50px;" alt="">
                        @endif
                      </td>
                      <td>{{ $value->name }} {{ $value->last_name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->gender }}</td>
                      <td>{{ $value->mobile_number }}</td>
                      <td>{{ $value->occupation }}</td>
                      <td>{{ $value->address }}</td>
                      <td>{{ ($value->status  == 0) ? 'Active' : 'Inactive'}}</td>
                      <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                      <td class="text-nowrap">
                          <a href="{{ url('admin/parent/edit/'.$value->id) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ url('admin/parent/delete/'.$value->id) }}" class="btn btn-danger btn-sm" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                          <a href="{{ url('admin/parent/my-student/'.$value->id) }}" class="btn btn-primary btn-sm" title="My Student">
                            <i class="fas fa-users"></i>
                          </a>
                          <a href="{{ url('chat?receiver_id='.base64_encode($value->id)) }}" class="btn btn-success" title="Send Message">
                            <i class="fas fa-paper-plane"></i>
                          </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-end">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
