@extends('layouts.master')

@section('content')
    <section class="mb-5">
        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#newProject">Add
            project
        </button>
    </section>
    <section class="mb-5">
        <table id="paginationFullNumbers" class="table">
            <thead>
            <tr>
                <th class="th-sm">Project Ref</th>
                <th class="th-sm">Country</th>
                <th class="th-sm">Implementing Office</th>
                <th class="th-sm">Project Title</th>
                <th class="th-sm">Grant Amount</th>
                <th class="th-sm">Dates from GCF</th>
                <th class="th-sm">Start date</th>
                <th class="th-sm">Duration (months)</th>
                <th class="th-sm">End date</th>
                <th class="th-sm">Readiness or NAP</th>
                <th class="th-sm">Type of readiness</th>
                <th class="th-sm">First disbursement amount</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr id="project{{ $project->id }}">
                    <td>{{ $project->reference }}</td>
                    <td>
                        @foreach($project->country_projects as $item)
                            {{ $item->countries->name }},
                        @endforeach
                    </td>
                    <td>{{ $project->office->name }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ number_format($project->grant_amount) }}</td>
                    <td>{{ $project->gcf_date }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->start_date)->diffInMonths($project->end_date) }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>{{ $project->read_nap }}</td>
                    <td>{{ $project->readiness_type->name }}</td>
                    <td>{{ isset($project->first_disbursement) ? number_format($project->first_disbursement) : ''}}</td>
                    <td>{{ $project->status->name }}</td>
                    <td>
                        <a href="#" class="mr-1 ml-1 viewProject" data-item="{{ $project->id }}"
                           data-countries="@foreach($project->country_projects as $item){{ $item->countries->name }},@endforeach"
                           data-ref="{{ $project->reference }}"
                           data-office="{{ $project->reference }}"
                           data-status="{{ $project->status->name }}"
                           data-readiness_type="{{ $project->readiness_type->name }}"
                           data-months="{{ \Carbon\Carbon::parse($project->start_date)->diffInMonths($project->end_date) }}"
                        ><i class="fas fa-eye cyan-text pr-2"></i></a>
                        <a href="#" class="mr-1 ml-3 editProject" data-item="{{ $project->id }}"
                           data-ref="{{ $project->reference }}">
                            <i class="fas fa-pencil-alt purple-text"></i>
                        </a>
                        <a href="#" class="ml-4 deleteProject" data-item="{{ $project->id }}"><i
                                class="fas fa-trash-alt red-text"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>

    <section class="mb-5">
        <!-- Modal -->
        <div class="modal fade" id="newProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content form-elegant">
                    <!--Header-->
                    <div class="modal-header text-center">
                        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Add
                                a new project</strong></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <form action="{{ url('/projects') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="modal-body mx-4">
                            <!--Body-->
                            <div class="md-form mb-5">
                                <input type="text" id="reference" name="reference" class="form-control validate"
                                       required>
                                <label data-error="wrong" data-success="right" for="ref">Reference</label>
                            </div>

                            <div class="md-form mb-5">
                                <input type="text" name="title" id="title" class="form-control validate" required>
                                <label data-error="wrong" data-success="right" for="title">Title</label>
                            </div>

                            <div class="form-row mb-5">
                                <div class="col">
                                    <!-- Country -->
                                    <select id="countrySelection" multiple="multiple" name="country[]" required>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <!-- Office -->
                                    <select id="officeSelection" name="office" required>
                                        @foreach($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-5">
                                <div class="col md-form">
                                    <input type="number" name="grant" id="grant" class="form-control validate" required>
                                    <label data-error="wrong" data-success="right" for="grant">Grant amount</label>
                                </div>
                                <div class="col md-form">
                                    <input type="number" name="first_disbursement" id="first_disbursement"
                                           class="form-control validate" required>
                                    <label data-error="wrong" data-success="right" for="first_disbursement">First
                                        disbursement</label>
                                </div>
                            </div>

                            <div class="md-form mb-5">
                                <input type="date" name="gcf_date" id="gcf_date" class="form-control validate" required>
                                <label data-error="wrong" data-success="right" for="gcf_date">Date from GCF</label>
                            </div>

                            <div class="form-row mb-5">
                                <div class="col md-form">
                                    <input type="date" name="start_date" id="start_date" class="form-control validate"
                                           required>
                                    <label data-error="wrong" data-success="right" for="start_date">Start date</label>

                                </div>
                                <div class="col md-form">
                                    <input type="date" name="end_date" id="end_date" class="form-control validate"
                                           required>
                                    <label data-error="wrong" data-success="right" for="end_date">End date</label>

                                </div>
                            </div>

                            <div class="form-row mb-5">
                                <div class="col">
                                    <select id="rnapSelection" name="r_nap" required>
                                        <option value="Readiness">Readiness</option>
                                        <option value="National Adaptation Plans">National Adaptation Plans</option>

                                    </select>
                                </div>
                                <div class="col">
                                    <select id="statusSelection" name="status" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-5">
                                <div class="col">
                                    <select id="readinessTypeSelection" name="readiness_type" required>
                                        @foreach($readiness_types as $readiness_type)
                                            <option
                                                value="{{ $readiness_type->id }}">{{ $readiness_type->name }}</option>

                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!-- Modal -->

        <!-- View Project Modal -->
        <div class="modal fade" id="viewProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content form-elegant">
                    <!--Header-->
                    <div class="modal-header text-center">
                        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Project
                                Ref <span id="reference"></span></strong></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="card card-cascade">
                        <div class="px-4">

                            <div class="table-wrapper">
                                <!--Table-->
                                <table class="table table-hover mb-0">

                                    <!--Table head-->
                                    <thead>
                                    <tr>
                                        <th class="th-lg">
                                        </th>
                                        <th class="th-lg">
                                        </th>
                                    </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody id="tbd"></tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>

                        </div>

                    </div>
                    <!-- Table with panel -->
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!-- Modal -->

        <!-- Edit Project Modal -->
        <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content form-elegant">
                    <!--Header-->
                    <div class="modal-header text-center">
                        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Edit
                                project ref <span id="ref"></span></strong></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <form action="{{ url('/projects/edit') }}" method="POST">
                        {!! csrf_field() !!}
                        <div id="editBody"></div>
                        <!--/.Content-->
                </div>
            </div>
            <!-- Modal -->

    </section>

@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            //Pagination full Numbers
            $('#paginationFullNumbers').DataTable({
                "pagingType": "full_numbers"
            });
        });

        $('#countrySelection').select2({
            placeholder: 'Select a country'
        });

        $('#officeSelection').select2({
            placeholder: 'Select a office'
        });

        $('#rnapSelection').select2({
            placeholder: 'Readiness/National Adaptation Plans'
        });

        $('#statusSelection').select2({
            placeholder: 'Select a status'
        });

        $('a.viewProject').click(function () {
            var item = $(this).data('item');
            var ref = $(this).data('ref');
            var status = $(this).data('status');
            var months = $(this).data('months');
            var office = $(this).data('office');
            var countries = $(this).data('countries');
            var readiness_type = $(this).data('readiness_type');
            $.ajax({
                url: '/projects/show/' + item,
                data: {
                    format: 'json'
                },
                error: function () {
                    swal("An error has occurred");
                },
                success: function (data) {
                    $('span#reference').append(ref)
                    $("#viewProject").modal("show");
                    $.each(data, function (i, val) {
                        $("#tbd").append('<tr><td>Reference</td><td class="reference">'+ data.reference +'</td></tr>' +
                            '<tr><td>Title</td><td class="title">'+ data.title +'</td></tr>' +
                            '<tr><td>Countries</td><td class="title">'+ countries +'</td></tr>' +
                            '<tr><td>Implementing Office</td><td class="office">'+ office +'</td></tr>' +
                            '<tr><td>Grant amount</td><td class="grant">'+ data.grant_amount +'</td></tr>' +
                            '<tr><td>First disbursement</td><td class="grant">'+ data.first_disbursement +'</td></tr>' +
                            '<tr><td>Date for GCF</td><td class="gcf">'+ data.gcf_date +'</td></tr>' +
                            '<tr><td>Start date</td><td class="start">'+ data.start_date +'</td></tr>' +
                            '<tr><td>End date</td><td class="end">'+ data.end_date +'</td></tr>' +
                            '<tr><td>Status</td><td class="end">'+ status +'</td></tr>' +
                            '<tr><td>Type of readiness</td><td class="end">'+ readiness_type +'</td></tr>' +
                            '<tr><td>Readiness or NAP</td><td class="end">'+ data.read_nap +'</td></tr>' +
                            '<tr><td>Duration in months</td><td class="months">'+ months +'</td>' +
                            '</tr>')
                        return i > 2;
                    })
                }
            });
        });

        $('a.editProject').click(function () {
            var item = $(this).data('item');
            var ref = $(this).data('ref');
            $.ajax({
                url: '/projects/show/' + item,
                data: {
                    format: 'json'
                },
                error: function () {
                    swal("An error has occurred");
                },
                success: function (data) {
                    $('span#ref').append(ref)
                    $("#editProject").modal("show");
                    $.each(data, function (i, val) {
                        $("#editBody").append('<div class="modal-body mx-4"><input value="' + data.id + '" name="project_id" hidden required>' +
                            '<div class="md-form mb-5"><input type="text" value="' + data.reference + '" id="reference" name="reference" class="form-control validate" required>' +
                            '<label data-error="wrong" class="active" data-success="right">Reference</label></div><div class="md-form mb-5">' +
                            '<input type="text" name="title" value="' + data.title + '" id="title" class="form-control validate" required>' +
                            '<label data-error="wrong" class="active" data-success="right" for="title">Title</label></div><div class="form-row mb-5">' +
                            '<div class="col"><select id="countrySelection" multiple="multiple" name="country[]" required>' +
                            '@foreach($countries as $country)<option value="{{ $country->id }}">{{ $country->name }}</option>' +
                            '@endforeach</select></div><div class="col"><select id="officeSelection" name="office" required>' +
                            '@foreach($offices as $office)<option value="{{ $office->id }}">{{ $office->name }}</option>' +
                            '@endforeach</select></div></div><div class="form-row mb-5"><div class="col md-form">' +
                            '<input type="number" name="grant" value="' + data.grant_amount + '" id="grant" class="form-control validate" required>' +
                            '<label data-error="wrong" class="active" data-success="right" for="grant">Grant amount</label></div>' +
                            '<div class="col md-form">' +
                            '<input type="number" name="first_disbursement" value="' + data.first_disbursement + '" id="first_disbursement" class="form-control validate" required>' +
                            '<label data-error="wrong" data-success="right" class="active" for="first_disbursement">First disbursement</label>' +
                            '</div></div><div class="md-form mb-5">' +
                            '<input type="date" name="gcf_date" value="' + data.gcf_date + '" id="gcf_date" class="form-control validate" required>' +
                            '<label data-error="wrong" class="active" data-success="right" for="gcf_date">Date from GCF</label></div>' +
                            '<div class="form-row mb-5"><div class="col md-form">' +
                            '<input type="date" name="start_date" value="' + data.start_date + '" id="start_date" class="form-control validate" required>' +
                            '<label data-error="wrong" class="active" data-success="right" for="start_date">Start date</label></div>' +
                            '<div class="col md-form">' +
                            '<input type="date" name="end_date" value="' + data.end_date + '" id="end_date" class="form-control validate" required>' +
                            '<label data-error="wrong" class="active" data-success="right" for="end_date">End date</label></div>' +
                            '</div><div class="form-row mb-5">' +
                            '<div class="col"><select id="rnapSelection" name="r_nap" required>' +
                            '<option value="Readiness">Readiness</option>' +
                            '<option value="National Adaptation Plans">National Adaptation Plans</option></select>' +
                            '</div><div class="col"><select id="statusSelection" name="status" required>' +
                            '@foreach($statuses as $status)<option value="{{ $status->id }}">{{ $status->name }}</option>' +
                            '@endforeach</select></div></div><div class="form-row mb-5"><div class="col">' +
                            '<select id="readinessTypeSelection" name="readiness_type" required>' +
                            '@foreach($readiness_types as $readiness_type)' +
                            '<option value="{{ $readiness_type->id }}">{{ $readiness_type->name }}</option>' +
                            '@endforeach</select></div></div><div class="text-center mb-3">' +
                            '<button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Submit</button></div>' +
                            '</div></form></div>');
                        $('select').select2();
                        return i > 2;
                    });
                }
            });
        });

        $('a.deleteProject').click(function () {
            var item = $(this).data('item');
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the record",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#BA0C2F",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: '/projects/delete/' + item,
                            error: function () {
                                swal("An error has occurred");
                            },
                            success: function () {
                                $('tr#project' + item).fadeOut(3000);
                            }
                        });
                        swal("Deleted!", "", "success");
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        });

        $('#editProject').on('hide.bs.modal', function () {
            $("#editBody>div.modal-body").remove();
            $("span").html("");
        });
        $('#viewProject').on('hide.bs.modal', function () {
            $("span").html("");
        });


    </script>

@endsection
