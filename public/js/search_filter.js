$(document).ready(function () {
    console.log("✅ search_filter.js loaded");
    $('#search').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('search-company') }}",
            type: "GET",
            data: { search: query },
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
                    rows = `<tr><td colspan="5">No companies found</td></tr>`;
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
                    rows = `<tr><td colspan="5">No companies found</td></tr>`;
                }

                $('tbody').html(rows);
            }
        });
    });
});