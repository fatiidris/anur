@extends('admin.frontend.layouts.layout')

@section('content')
<div class="container">
    <!-- Sub Header -->
    <section class="sub-header">
        <h1>Results in Progress</h1>
    </section>

    <!-- Result Processing Info Section -->
    <div class="result-info" style="text-align: center; margin-top: 20px; padding: 30px;">
        <p style="font-size: 18px; color: #333;">
            Dear Students and Parents, please be informed that the <strong>academic results are currently being processed</strong>.
        </p>
        <p style="font-size: 16px; color: #555; margin-top: 10px;">
            Our teachers and administrators are working carefully to ensure accuracy and fairness in grading.
            The final results will be released soon. Kindly check back later for updates.
        </p>

        <div style="margin-top: 25px;">
            <i class="fas fa-spinner fa-spin" style="font-size: 40px; color: #007bff;"></i>
            <p style="margin-top: 10px; font-size: 16px; color: #007bff;">Processing... Please wait</p>
        </div>

        <a href="{{ url('/') }}" class="blue-btn" style="margin-top: 30px; display: inline-block; padding: 10px 25px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">
            Return to Home
        </a>
    </div>
</div>
@endsection
