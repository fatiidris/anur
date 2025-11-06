@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid px-4">
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Frontend Updates Page Settings</h4>
        </div>

        <div class="card-body">
            @include('_message')
            <form action="{{ url('admin/frontend/updates-setting/update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- INTRO SECTION --}}
            <h5 class="mt-3 mb-3 text-primary fw-bold">Intro Section (Frontend Main Heading & Paragraph)</h5>
                <div class="mb-3">
                    <label class="form-label">Main Heading (e.g. Capturing Our School Moments)</label>
                    <input type="text" name="update_intro_title" class="form-control" value="{{ old('update_intro_title', $setting->update_intro_title ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Intro Paragraph</label>
                    <textarea name="update_intro_description" rows="3" class="form-control">{{ old('update_intro_description', $setting->update_intro_description ?? '') }}</textarea>
                </div>

                {{-- FIRST GALLERY --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">First Gallery Images (1-5)</h5>
                <div class="row">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gallery Image {{ $i }}</label>
                            <input type="file" name="update_gallery_image_{{ $i }}" class="form-control">
                            @php $img = $setting->{'update_gallery_image_'.$i} ?? ''; @endphp
                            <div class="mt-2">
                                <img src="{{ url('public/frontend/Img/'.($img ?: 'default.jpg')) }}" style="height:80px; border-radius:5px;{{ $img ? '' : 'opacity:0.6;' }}">
                            </div>
                        </div>
                    @endfor
                </div>

                {{-- MIDDLE DESCRIPTION --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Middle Section</h5>
                <div class="mb-3">
                    <label class="form-label">Middle Title</label>
                    <input type="text" name="update_middle_title" class="form-control" value="{{ old('update_middle_title', $setting->update_middle_title ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Middle Description</label>
                    <textarea name="update_middle_description" rows="3" class="form-control">{{ old('update_middle_description', $setting->update_middle_description ?? '') }}</textarea>
                </div>

                {{-- SECOND GALLERY --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Second Gallery Images (6-10)</h5>
                <div class="row">
                    @for ($i = 6; $i <= 10; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gallery Image {{ $i - 5 }}</label>
                            <input type="file" name="update_gallery_image_{{ $i }}" class="form-control">
                            @php $img = $setting->{'update_gallery_image_'.$i} ?? ''; @endphp
                            <div class="mt-2">
                                <img src="{{ url('public/frontend/Img/'.($img ?: 'default.jpg')) }}" style="height:80px; border-radius:5px;{{ $img ? '' : 'opacity:0.6;' }}">
                            </div>
                        </div>
                    @endfor
                </div>

                {{-- FOOTER SECTION --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Footer Section</h5>
                <div class="mb-3">
                    <label class="form-label">Footer Title</label>
                    <input type="text" name="update_footer_title" class="form-control" value="{{ old('update_footer_title', $setting->update_footer_title ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Footer Description</label>
                    <textarea name="update_footer_description" rows="3" class="form-control">{{ old('update_footer_description', $setting->update_footer_description ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Save Updates Settings</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
