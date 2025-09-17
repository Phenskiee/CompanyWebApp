@extends('layout.app')

@section('title', 'Home Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')
    <div class="index-container">
        <div class="index-header">
            <h1>CAMPANY MANAGEMENT SYSTEMS</h1>
        </div>
        <div class="index-card-container">
            <div class="index-card">
                <span>{{ $totalCompany }}</span>
                <p>Company</p>
            </div>
            <div class="index-card">
                <span>{{ $totalApplied }}</span>
                <p>Applied Company</p>
            </div>
            <div class="index-card">
                <span>{{ $totalViewed }}</span>
                <p>Viewed</p>
            </div>
            <div class="index-card">
                <span>{{ $totalInterview }}</span>
                <p>Interview</p>
            </div>
            <div class="index-card">
                <span>{{ $totalPending }}</span>
                <p>Pending</p>
            </div>
            <div class="index-card">
                <span>{{ $totalReject}}</span>
                <p>Rejected</p>
            </div>
            <div class="index-card">
                <span>{{ $totalInterviewPending}}</span>
                <p>Interview Status (Pending)</p>
            </div>
            <div class="index-card">
                <span>{{ $totalInterviewReject}}</span>
                <p>Interview Status (Rejected)</p>
            </div>
            <div class="index-card">
                <span>{{ $totalJo }}</span>
                <p>Job Offer</p>
            </div>
        </div>
    </div>
@endsection