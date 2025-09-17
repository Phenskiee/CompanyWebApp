@extends('layout.app')

@section('title', 'Company List')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endpush

@section('content')
    <div class="company-header">
        <h2>COMPANY LIST</h2>
    </div>
    <div class="search-container">
        <div class="search-content">
            <input type="text"  id="search" placeholder="Enter company name">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div class="add-btn">
            <button id="openForm">Add Company</button>
        </div>
    </div>
    @if (session('add'))
        <div class="session-container">
            <div class="status-alert">
                <p>
                    <strong>{{ session('add') }}</strong> is Added
                </p>
            </div>
        </div>
    @elseif(session('applied'))
        <div class="session-container">
            <div class="status-alert">
                <p>
                    Your applied in <strong>{{ session('applied') }}</strong>
                </p>
            </div>
        </div>
    @elseif(session('error'))
        <div class="session-container">
            <div class="status-alert">
                <p>
                    You have already applied to <strong>{{ session('error') }}.</strong>
                </p>
            </div>
        </div>
    @elseif($errors->any())
        <div class="session-container">
            <div class="status-alert error">
                <p>
                    {{ $errors->first() }}
                </p>
            </div>
        </div>
    @endif
    @if ($list->isEmpty()) 
            <div class="notif">
                <h1>NO LIST</h1>
            </div>
    @else
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="company-name">Company Name</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th>Setup</th>
                        <th>Platform</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="company-table">
                    @foreach ($list as $lists )
                        <tr>
                            <td>{{$lists->name}}</td>
                            <td>{{$lists->position}}</td>
                            <td>{{$lists->location}}</td>
                            <td>{{$lists->setup}}</td>
                            <td>{{$lists->platform}}</td>
                            <td>
                                <div class="action-btn">
                                    <form action="{{ route('apply-company', $lists->id)}}" method="POST">
                                        @csrf
                                        <button class="apply">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('delete-data', $lists->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="del"
                                        onclick="return confirm('You want to delete {{$lists->name}}?');">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $list->links('vendor.pagination.custom') }}
            </div>
        </div>
    @endif

    {{-- FORM MODAL --}}
    <div class="form-container" id="formContainer">
        <div class="form-content">
            <div class="form-close-btn">
                <i id="closeForm" class="fa-solid fa-xmark"></i>
            </div>
            <form action="{{route('store-company')}}" method="POST">
                @csrf
                <div class="form-input-container">
                    <div class="form-card-container">
                        <div class="form-card">
                            <label for="name">Company Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter company name" autocomplete="off" required>
                        </div>
                        <div class="form-card">
                            <label for="position">Position</label>
                            <input type="text" id="position" name="position" placeholder="Enter position" autocomplete="off" required>
                        </div>
                        <div class="form-card">
                            <label for="salary">Salary</label>
                            <input type="text" id="salary" name="salary" placeholder="Enter salary" autocomplete="off">
                        </div>
                        <div class="form-card">
                            <label for="setup">Setup</label>
                            <select name="setup" id="choices">
                                <option value="">Select Option</option>
                                <option value="Onsite">Onsite</option>
                                <option value="Work from Home">Work from Home</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-card-container">
                        <div class="form-card">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter email" autocomplete="off">
                        </div>
                        <div class="form-card">
                            <label for="pltform">Platform</label>
                            <select name="platform" id="choices">
                                <option value="">Select Option</option>
                                <option value="Facebook">Facebook</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Jobstreet">Jobstreet</option>
                                <option value="Indeed Phillippines">Indeed Philippines</option>
                                <option value="Boss Jobs">Boss Jobs</option>
                                <option value="Site and Others">Site and Others</option>
                            </select>
                        </div>
                        <div class="form-card">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" placeholder="Enter location" autocomplete="off">
                        </div>
                        <div class="form-card">
                            <label for="url">Links</label>
                            <input type="url" id="url" name="links" placeholder="Enter Links" autocomplete="off"></input>
                        </div>
                    </div>

                    {{-- <div class="form-card-container">
                        <div class="form-card">
                            <label for="status">Status</label>
                            <select name="status" id="">
                                <option value="" aria-placeholder="status"></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
    
                        <div class="form-card">
                            <label for="interview_status">Status after Interview</label>
                            <select name="interview_status" id="">
                                <option value="" aria-placeholder="Status after Interview"></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="form-card">
                            <label for="date_interview">Date of Interview</label>
                            <input type="date" name="interview_date">
                        </div>
                        <div class="form-card">
                            <label for="time_interview">Time of Interview</label>
                            <input type="time" name="interview_time">
                        </div>
                    </div> --}}
                </div>

                
                <div class="form-job-description">
                    <label for="jobdescription">Job Description</label>
                    <textarea id="jobdescription" name="job_description" placeholder="Enter job description"></textarea>
                </div>

                <div class="form-btn">
                    <button type="submit" class="add">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/layout.js')}}"></script>
    <script>
        $(document).ready(function () {
            
            $('#search').on('keyup', function () {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('search-company') }}",
                    type: "GET",
                    data: { search: query, context: 'companyList' },
                    success: function (data) {
                        let rows = "";

                        if (data.length > 0) {
                            $.each(data, function (index, list) {
                                rows += `
                                    <tr>
                                        <td>${list.name}</td>
                                        <td>${list.position ?? ''}</td>
                                        <td>${list.location ?? ''}</td>
                                        <td>${list.setup ?? ''}</td>
                                        <td>${list.platform ?? ''}</td>
                                        <td>
                                            <div class="action-btn">
                                                <form action="${list.apply_url}" method="POST" class="apply-form">
                                                    @csrf
                                                    <button class="apply">
                                                        <i class="fa-solid fa-paper-plane"></i>
                                                    </button>
                                                </form>
                                                <form action="${list.delete_url}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="del" onclick="return confirm('You want to delete ${list.name}?');">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                            });
                        } else {
                            rows = 
                            `<tr>
                                <td colspan="6">No companies found</td>
                            </tr>`;
                        }

                        $('#company-table').html(rows);
                    }
                });
            });
        });
    </script>
@endpush