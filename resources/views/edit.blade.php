@extends('layout.app')

@section('title', 'Response Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/show.css') }}"> --}}
@endpush

@section('content')
    <div class="form-container">
        {{-- <div class="form-close-btn">
            <i id="closeForm" class="fa-solid fa-xmark"></i>
        </div> --}}
        <form action="{{ route('update-company', $info->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-input-container">
                <div class="form-card-container">
                    <div class="form-card">
                        <label for="name">Company Name</label>
                        <input type="text" id="name" name="name" value="{{ $info->name }} " required>
                    </div>
                    <div class="form-card">
                        <label for="position">Position</label>
                        <input type="text" id="position" name="position" value="{{ $info->position }}" required>
                    </div>
                    <div class="form-card">
                        <label for="salary">Salary</label>
                        <input type="text" id="salary" name="salary" value="{{ $info->salary }}">
                    </div>
                    <div class="form-card">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="" disabled {{ $info->status == null ? 'selected' : '' }}>
                                Select status
                            </option>
                            <option value="Viewed" {{ $info->status == 'Viewed' ? 'select' : '' }}>
                                Viewed
                            </option>
                            <option value="Pending" {{ $info->status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="For Interview" {{ $info->status == 'For Interview' ? 'selected' : '' }}>
                                For Interview
                            </option>
                            <option value="Rejected" {{ $info->status == 'Rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>
                    </div>

                    <div class="form-card">
                        <label for="time_interview">Status after Interview</label>
                        <select name="interview_status" id="interview_status">
                            <option value="" disabled {{ $info->interview_status == null ? 'selected' : '' }}>
                                Select status
                            </option>
                            <option value="Pending" {{ $info->interview_status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="Rejected" {{ $info->interview_status == 'Rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                            <option value="Job Offer" {{ $info->interview_status == 'Job Offer' ? 'selected' : '' }}>
                                Job Offer
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-card-container">
                    <div class="form-card">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $info->email}}">
                    </div>
                    <div class="form-card">
                        <label for="pltform">Platform</label>
                        <select name="platform" id="choices">
                            <option value="Facebook" {{ $info->platform === 'Facebook' ? 'selected' : '' }}>
                                Facebook
                            </option>
                            <option value="LinkedIn" {{ $info->platform === 'LinkedIn' ? 'selected' : '' }}>
                                LinkedIn
                            </option>
                            <option value="Jobstreet" {{ $info->platform === 'Jobstreet' ? 'selected' : '' }}>
                                Jobstreet
                            </option>
                            <option value="Indeed Phillippines" {{ $info->platform === 'Indeed Phillippines' ? 'selected' : '' }}>
                                Indeed Phillippines
                            </option>
                            <option value="Boss Jobs" {{ $info->platform === 'Boss Jobs' ? 'selected' : '' }}>
                                Boss Jobs
                            </option>
                            <option value="Site and Email" {{ $info->platform === 'Site and Others' ? 'selected' : '' }}>
                                FB and Email
                            </option>
                        </select>
                    </div>
                    <div class="form-card">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $info->location) }}">
                    </div>
                    <div class="form-card date-time">
                        <label for="interview_date">Date of Interview</label>
                        <input type="date" name="interview_date" id="interview_date" value="{{ old('interview_date', $info->interview_date) }}">
                    </div>
                    <div class="form-card date-time">
                        <label for="interview_time">Time of Interview</label>
                        <input type="time" name="interview_time" id="interview_time" value="{{ $info->interview_time ? \Carbon\Carbon::parse($info->interview_time)->format('H:i') : '' }}">
                    </div>
                </div>
            </div>
            <div class="form-job-description">
               <label for="jobsdescription">Job Description</label>
               <textarea id="jobdescription" name="job_description">{{ $info->job_description}}</textarea>
           </div>
           <div class="form-btn">
                <button type="submit" class="add">UPDATE</button>
            </div>
            <div class="form-btn">
                 <a href=" {{ route('response-page')}}">CANCEL</a>
                 {{-- <button type="submit" class="add">Add</button> --}}
             </div>
        </form>
    </div>

@endsection