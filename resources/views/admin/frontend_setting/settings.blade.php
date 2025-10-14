@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Frontend Settings</h1>
                    </div>
                </div>
            </div>
        </section>
        @include('_message')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form method="post" action="{{ url('admin/frontend-settings/update') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $getRecord->address }}" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $getRecord->phone }}" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $getRecord->email }}" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input type="text" class="form-control" name="facebook_url" value="{{ $getRecord->facebook_url }}" placeholder="Facebook URL">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter URL</label>
                                        <input type="text" class="form-control" name="twitter_url" value="{{ $getRecord->twitter_url }}" placeholder="Twitter URL">
                                    </div>
                                    <div class="form-group">
                                        <label>LinkedIn URL</label>
                                        <input type="text" class="form-control" name="linkedin_url" value="{{ $getRecord->linkedin_url }}" placeholder="LinkedIn URL">
                                    </div>
                                    <div class="form-group">
                                        <label>YouTube URL</label>
                                        <input type="text" class="form-control" name="youtube_url" value="{{ $getRecord->youtube_url }}" placeholder="YouTube URL">
                                    </div>
                                    <div class="form-group">
                                        <label>About Us</label>
                                        <textarea class="form-control" name="about_us" rows="5" placeholder="About Us">{{ $getRecord->about_us }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection