@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Page Header -->
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

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card card-primary">
            <form action="{{ route('admin.frontend-settings.update') }}" method="POST" enctype="multipart/form-data">
              @csrf

              {{-- HOME SECTION --}}
              <div class="card-header">
                <h3 class="card-title">Home Section</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Home Title</label>
                  <input type="text" name="home_title" class="form-control" 
                    value="{{ old('home_title', $getRecord->home_title) }}">
                </div>

                <div class="form-group">
                  <label>Home Subtitle</label>
                  <input type="text" name="home_subtitle" class="form-control" 
                    value="{{ old('home_subtitle', $getRecord->home_subtitle) }}">
                </div>
              </div>

              {{-- CAROUSEL SECTION --}}
              @for ($i = 1; $i <= 4; $i++)
                <div class="card-header bg-secondary">
                  <h3 class="card-title">Carousel Slide {{ $i }}</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Title {{ $i }}</label>
                    <input type="text" name="carousel_title_{{ $i }}" class="form-control" 
                      value="{{ old('carousel_title_'.$i, $getRecord->{'carousel_title_'.$i}) }}">
                  </div>

                  <div class="form-group">
                    <label>Text {{ $i }}</label>
                    <textarea name="carousel_text_{{ $i }}" class="form-control">{{ old('carousel_text_'.$i, $getRecord->{'carousel_text_'.$i}) }}</textarea>
                  </div>

                  <div class="form-group">
                    <label>Image {{ $i }}</label>
                    <input type="file" name="carousel_image_{{ $i }}" class="form-control">

                    @php
                      $imageField = 'carousel_image_'.$i;
                    @endphp

                    @if(!empty($getRecord->$imageField))
                      <div style="margin-top:10px;">
                        <img src="{{ url('public/frontend/Img/'.$getRecord->$imageField) }}" 
                          alt="Carousel Image {{ $i }}" 
                          style="height:80px; border-radius:5px;">
                      </div>
                    @else
                      <div style="margin-top:10px;">
                        <img src="{{ url('public/frontend/Img/default.jpg') }}" 
                          alt="Default Carousel Image {{ $i }}" 
                          style="height:80px; border-radius:5px; opacity:0.6;">
                      </div>
                    @endif
                  </div>
                </div>
              @endfor

              {{-- ABOUT SECTION --}}
              <div class="card-header">
                <h3 class="card-title">About Section</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>About Title</label>
                  <input type="text" name="about_title" class="form-control" 
                    value="{{ old('about_title', $getRecord->about_title) }}">
                </div>

                <div class="form-group">
                  <label>About Description</label>
                  <textarea name="about_description" class="form-control">{{ old('about_description', $getRecord->about_description) }}</textarea>
                </div>

                <div class="form-group">
                  <label>About Image</label>
                  <input type="file" name="about_image" class="form-control">

                  @if(!empty($getRecord->about_image))
                    <div style="margin-top:10px;">
                      <img src="{{ url('public/frontend/Img/'.$getRecord->about_image) }}" 
                        alt="About Image" 
                        style="height:80px; border-radius:5px;">
                    </div>
                  @else
                    <div style="margin-top:10px;">
                      <img src="{{ url('public/frontend/Img/default.jpg') }}" 
                        alt="Default About Image" 
                        style="height:80px; border-radius:5px; opacity:0.6;">
                    </div>
                  @endif
                </div>
              </div>

              {{-- CONTACT SECTION --}}
              <div class="card-header">
                <h3 class="card-title">Contact Section</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Contact Title</label>
                  <input type="text" name="contact_title" class="form-control" 
                    value="{{ old('contact_title', $getRecord->contact_title) }}">
                </div>

                <div class="form-group">
                  <label>Contact Image</label>
                  <input type="file" name="contact_image" class="form-control">

                  @if(!empty($getRecord->contact_image))
                    <div style="margin-top:10px;">
                      <img src="{{ url('public/frontend/Img/'.$getRecord->contact_image) }}" 
                        alt="Contact Image" 
                        style="height:80px; border-radius:5px;">
                    </div>
                  @else
                    <div style="margin-top:10px;">
                      <img src="{{ url('public/frontend/Img/default.jpg') }}" 
                        alt="Default Contact Image" 
                        style="height:80px; border-radius:5px; opacity:0.6;">
                    </div>
                  @endif
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Settings</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>

</div>
@endsection
