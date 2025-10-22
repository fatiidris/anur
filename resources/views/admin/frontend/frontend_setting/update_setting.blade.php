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

                {{-- ================= INTRO SECTION ================= --}}
                <h5 class="mt-3 mb-3 text-primary fw-bold">Intro Section</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Title</label>
                        <input type="text" name="update_intro_title" class="form-control" 
                               value="{{ old('update_intro_title', $getSetting->update_intro_title ?? '') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="update_intro_description" rows="3" class="form-control">{{ old('update_intro_description', $getSetting->update_intro_description ?? '') }}</textarea>
                    </div>
                </div>

                {{-- ================= FIRST GALLERY ================= --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">First Gallery Images</h5>
                <div class="row">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gallery Image {{ $i }}</label>
                            <input type="file" name="update_gallery_image_{{ $i }}" class="form-control">
                            @php
                                $img = $getSetting->{'update_gallery_image_'.$i} ?? '';
                            @endphp
                            @if(!empty($img))
                                <img src="{{ url('public/frontend/Img/'.$img) }}" 
                                     alt="Gallery {{ $i }}" 
                                     style="width: 100%; max-width: 200px; margin-top: 10px; border-radius: 8px;">
                            @endif
                        </div>
                    @endfor
                </div>

                {{-- ================= MIDDLE DESCRIPTION ================= --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Middle Description Section</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Middle Title</label>
                        <input type="text" name="update_middle_title" class="form-control"
                               value="{{ old('update_middle_title', $getSetting->update_middle_title ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Middle Description</label>
                        <textarea name="update_middle_description" rows="3" class="form-control">{{ old('update_middle_description', $getSetting->update_middle_description ?? '') }}</textarea>
                    </div>
                </div>

                {{-- ================= SECOND GALLERY ================= --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Second Gallery Images</h5>
                <div class="row">
                    @for ($i = 6; $i <= 10; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gallery Image {{ $i - 5 }}</label>
                            <input type="file" name="update_gallery_image_{{ $i }}" class="form-control">
                            @php
                                $img = $getSetting->{'update_gallery_image_'.$i} ?? '';
                            @endphp
                            @if(!empty($img))
                                <img src="{{ url('public/frontend/Img/'.$img) }}" 
                                     alt="Gallery {{ $i - 5 }}" 
                                     style="width: 100%; max-width: 200px; margin-top: 10px; border-radius: 8px;">
                            @endif
                        </div>
                    @endfor
                </div>

                {{-- ================= FOOTER SECTION ================= --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Footer Section</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Footer Title</label>
                        <input type="text" name="update_footer_title" class="form-control"
                               value="{{ old('update_footer_title', $getSetting->update_footer_title ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Footer Description</label>
                        <textarea name="update_footer_description" rows="3" class="form-control">{{ old('update_footer_description', $getSetting->update_footer_description ?? '') }}</textarea>
                    </div>
                </div>

                {{-- ================= SAVE BUTTON ================= --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Updates Settings</button>
                </div>

            </form>
        </div>
    </div>
 </div>
</div>
@endsection
