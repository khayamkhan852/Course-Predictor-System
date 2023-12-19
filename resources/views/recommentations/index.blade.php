@extends('layouts.app')
@section('title', 'Recommendation')
@section('css')

@endsection
@section('content')
    <x-breadcrum name="Recommendation" page-name="Recommendation" button-url="{{ route('recommendations.check') }}" button-text="Check For Recommendations" />

    <div class="docs-content d-flex flex-column flex-column-fluid" id="kt_docs_content">
        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <div class="pb-10">
                        <p style="font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 18px; line-height: 1.6; margin-bottom: 20px; text-align: justify;">
                            Welcome to our personalized
                            <span style="color: #3498db; font-weight: bold;">recommendation module</span>,
                            crafted to guide students toward academic excellence. 🚀
                            We understand the pivotal role subject selection plays in boosting grades.
                            Our cutting-edge recommendation system analyzes your academic history, interests, and goals to
                            suggest subjects tailored just for you. <br>
                            Whether you're looking to strengthen core concepts or explore new realms, our recommendations align
                            with your unique learning profile.
                            Empower yourself with knowledge tailored to your needs.
                            Your success is our mission. 🌟 Explore our recommendations and chart your course to academic brilliance!
                            <br><br>
                            In order to check for recommendations, Click on the button above and the system will automatically recommend courses for you
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
