@extends('layout.app')

@section('title', 'Response Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')
    <div class="info-container" id="infoContainer">
        <div class="info-content">
            <div class="form-header">
                <div class="header">
                    <h3>{{ $details->name }}</h3>
                </div>
                <div class="form-close-btn">
                    <a href="{{ route('response-page')}}"><i id="closeInfo" class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
            <div class="info">
                <div class="info-details">
                    {{-- <p><strong>Company Name: </strong>
                        <span> {{ $details->name }}</span>
                    </p> --}}
                    <p>
                        <strong>Position: </strong>
                        <span>{{ $details->position }}</span>
                    </p>
                    <p>
                        <strong>Email: </strong>
                        <span> {{$details->email }}</span>
                    </p>
                    <p>
                        <strong>Salary: </strong>
                        <span>{{$details->salary }}</span>
                    </p>
                    <p>
                        <strong>Platform: </strong>
                        <span>{{$details->platform }}</span> 
                    </p>
                    <p>
                        <strong>Location: </strong>
                        <span>{{$details->location }}</span>
                    </p>
                </div>
                <div class="info-details">
                    <p>
                        <strong>Application Date: </strong>
                        <span>{{$details->applied_at }}</span>
                    </p>
                    <p>
                        <strong>Setup: </strong>
                        <span>{{$details->setup }}</span>
                    </p>
                    <p>
                        <strong>Status: </strong>
                        @if ($details->status == "Rejected")
                            <span class="reject">
                                {{ $details->status }}
                            </span>
                        @elseif($details->status == "For Interview")
                            <span class="interview">
                                {{ $details->status }}
                            </span>
                        @elseif($details->status == "Pending")
                            <span class="pending">
                                {{ $details->status }}
                            </span>
                        @elseif($details->status == "Viewed")
                            <span class="viewed">
                                {{ $details->status }}
                            </span>
                        @endif
                    </p>
                    <p>
                        <strong>Date of Interview: </strong>
                        <span>{{ $details->interview_date ? \Carbon\Carbon::parse($details->interview_date)->format('M d, Y') : '' }}
                            </span>
                    </p>
                    <p>
                        <strong>Time of Interview: </strong>
                        <span>{{ $details->interview_time ? \Carbon\Carbon::parse($details->interview_time)->format('h:i A') : '' }}
                        </span>
                    </p>
                    <p>
                        <strong>Status after Interview: </strong>
                        @if ($details->interview_status == "Rejected")
                            <span class="reject">
                                {{ $details->interview_status }}
                            </span>
                        @elseif($details->interview_status == "Job Offer")
                            <span class="jobOffer">
                                {{ $details->interview_status }}
                            </span>
                        @elseif($details->interview_status == "Pending")
                            <span class="pending">
                                {{ $details->interview_status }}
                            </span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="info-job-description">
                    <p><strong>Job Description: </strong></p>
                    <div class="info-job-description-content">
                        {{$details->job_description}}
                    </div>
            </div>
        </div>
    </div>
@endsection