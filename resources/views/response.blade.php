@extends('layout.app')

@section('title', 'Response Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endpush

@section('content')
    <div class="company-header">
        <h2>COMPANY RESPONSE</h2>
    </div>
    <div class="search-container">
        <div class="search-content">
            {{-- <form id="searchForm" action="{{ route('search-company')}}" method="GET">
                <input 
                type="text" 
                name="search"
                placeholder="Enter Company name"
                value="{{ $search ?? ""}}"
                autocomplete="off"
                >
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form> --}}
            <input type="text"  id="search" placeholder="Enter company name">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div class="search-select-content">
            <select id="statusDropdown" name="status">
                <option value=""> All Status </option>
                <option value="Viewed"> Viewed </option>
                <option value="For Interview"> For Interview </option>
                <option value="Rejected"> Rejected </option>
                <option value="Pending"> Pending </option>
                <option value="Job Offer"> Job Offer </option>
            </select>
        </div>
    </div>
    @if ($responses->isEmpty())
        <div class="notif">
            <h1>NO COMPANY FOUND</h1>
        </div>
    @else
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="company-name">Company Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Interview Status</th>
                        <th>Application</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="company-table">
                    @foreach ($responses as $response )
                        <tr  class="{{ $response->status_class }}">
                            <td>{{ $response->name }}</td>
                            <td>{{ $response->position }}</td>
                            <td>{{ $response->status }}</td>
                            <td>{{ $response->interview_status }}</td>
                            <td>{{ $response->applied_at }}</td>
                            <td>
                                <div class="btn-action">
                                    <a class="eye" href="{{ route('show-page', $response->id) }}">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a class="pen" href="{{ route('edit-page', $response->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $responses->links('vendor.pagination.custom') }}
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
        console.log("✅ search_filter.js loaded");
        $('#search').on('keyup', function () {
            let query = $(this).val();

            $.ajax({
                url: "{{ route('search-company') }}",
                type: "GET",
                data: { search: query, context: 'response' },
                success: function (data) {
                    let rows = "";

                    if (data.length > 0) {
                        $.each(data, function (index, response) {
                            rows += `
                                <tr class="${response.status_color}">
                                    <td>${response.name}</td>
                                    <td>${response.position ?? ''}</td>
                                    <td>${response.status ?? ''}</td>
                                    <td>${response.interview_status ?? ''}</td>
                                    <td>${response.applied_at ?? ''}</td>
                                    <td>
                                        <div class="btn-action">
                                            <a class="eye" href="${response.view_url}">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                            <a class="pen" href="${response.edit_url}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
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

        $('#statusDropdown').on('change', function () {
            let status = $(this).val();

            $.ajax({
                url: "{{ route('filter-company') }}",
                type: "GET",
                data: { status:status },
                success: function (data) {
                    let rows = "";

                    if (data.length > 0) {
                        $.each(data, function (index, response) {
                            rows += `
                                <tr class="${response.status_color}">
                                    <td>${response.name}</td>
                                    <td>${response.position ?? ''}</td>
                                    <td>${response.status ?? ''}</td>
                                    <td>${response.interview_status ?? ''}</td>
                                    <td>${response.applied_at ?? ''}</td>
                                    <td>
                                        <div class="btn-action">
                                            <a class="eye" href="${response.view_url}">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                            <a class="pen" href="${response.edit_url}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        rows = `<tr><td colspan="6">No companies found</td></tr>`;
                    }

                    $('tbody').html(rows);
                }
            });
        });
    });
    </script>
@endpush