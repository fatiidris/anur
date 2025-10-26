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
                         value="{{ old('update_intro_title', $setting->update_intro_title ?? '') }}"> {{-- CORRECTED --}}
                    </div>

                <div class="col-md-12 mb-3">
                     <label class="form-label">Intro Description</label>
                            <textarea name="update_intro_description" rows="3" class="form-control">{{ old('update_intro_description', $setting->update_intro_description ?? '') }}</textarea> {{-- CORRECTED --}}
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
                                    // $img holds the filename or an empty string
                                    // Assuming $setting is the correct variable passed from the controller
                                    $img = $setting->{'update_gallery_image_'.$i} ?? ''; 
                                @endphp

                                {{-- CHECK: Check if the filename ($img) is NOT empty --}}
                                @if(!empty($img))
                                    <div style="margin-top:10px;">
                                        {{-- FIX 1 & 2: Remove 'public/' and use the correct variable ($img) --}}
                                        <img src="{{ url('public/frontend/Img/'.$img) }}" 
                                            alt="Gallery {{ $i }}" 
                                            style="width: 100%; max-width: 200px; margin-top: 10px; border-radius: 8px;">
                                    </div>
                                @else
                                    <div style="margin-top:10px;">
                                        <img src="{{ url('public/frontend/Img/default.jpg') }}" {{-- FIX 3: Also remove 'public/' from default image --}}
                                            alt="Default Gallery Image {{ $i }}" 
                                            style="height:80px; border-radius:5px; opacity:0.6;">
                                    </div>
                                @endif
                                </div> {{-- This closing div seems to correspond to the col-md-4 or similar wrapper --}}
                                @endfor
                                </div>

            {{-- ================= MIDDLE DESCRIPTION ================= --}}
                <h5 class="mt-4 mb-3 text-primary fw-bold">Middle Description Section</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                            <label class="form-label">Middle Title</label>
                        <input type="text" name="update_middle_title" class="form-control"
                        value="{{ old('update_middle_title', $setting->update_middle_title ?? '') }}"> {{-- CORRECTED --}}
                    </div>
                <div class="col-md-12 mb-3">
                      <label class="form-label">Middle Description</label>
                    <textarea name="update_middle_description" rows="3" class="form-control">{{ old('update_middle_description', $setting->update_middle_description ?? '') }}</textarea> {{-- CORRECTED --}}
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
                                        // $img holds the filename or an empty string
                                        // Assuming $setting is the correct variable passed from the controller
                                        $img = $setting->{'update_gallery_image_'.$i} ?? ''; 
                                    @endphp

                                    {{-- CHECK: Check if the filename ($img) is NOT empty --}}
                                    @if(!empty($img))
                                        <div style="margin-top:10px;">
                                            {{-- FIX 1 & 2: Remove 'public/' and use the correct variable ($img) --}}
                                            <img src="{{ url('public/frontend/Img/'.$img) }}" 
                                                alt="Gallery {{ $i }}" 
                                                style="width: 100%; max-width: 200px; margin-top: 10px; border-radius: 8px;">
                                        </div>
                                    @else
                                <div style="margin-top:10px;">
                                    <img src="{{ url('public/frontend/Img/default.jpg') }}" {{-- FIX 3: Also remove 'public/' from default image --}}
                                        alt="Default Gallery Image {{ $i }}" 
                                        style="height:80px; border-radius:5px; opacity:0.6;">
                                 </div>
                                    @endif
                                </div> {{-- This closing div seems to correspond to the col-md-4 or similar wrapper --}}
                                    @endfor
                            </div>
                    
            {{-- ================= FOOTER SECTION ================= --}}
                     <h5 class="mt-4 mb-3 text-primary fw-bold">Footer Section</h5>
                  <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Footer Title</label>
                            <input type="text" name="update_footer_title" class="form-control"
                                value="{{ old('update_footer_title', $setting->update_footer_title ?? '') }}"> {{-- CORRECTED --}}
                        </div>
                     <div class="col-md-12 mb-3">
                        <label class="form-label">Footer Description</label>
                     <textarea name="update_footer_description" rows="3" class="form-control">{{ old('update_footer_description', $setting->update_footer_description ?? '') }}</textarea> {{-- CORRECTED --}}
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