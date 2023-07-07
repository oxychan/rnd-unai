@extends('layouts.app')
@section('title', 'Permohonan Masuk')

@push('additional_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Notice-->
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Data Permohonan Diajukan
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        {{ $dataTable->table() }}
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

@endsection

@push('data_tables')
    {{ $dataTable->scripts() }}
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $('#incommingrequestworker-table').on('click', '#btnAccept', function() {
            let data = $(this).data()
            let id = data.id

            $.ajax({
                method: 'PUT',
                url: 'accept/' + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                },
                success: function(response) {
                    Swal.fire(
                        'Accepted!',
                        response.message,
                        'success'
                    )
                    location.reload()
                }
            })
        })

        $('#incommingrequestworker-table').on('click', '#btnReject', function() {
            let data = $(this).data()
            let id = data.id

            $.ajax({
                method: 'PUT',
                url: 'reject/' + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                },
                success: function(response) {
                    Swal.fire(
                        'Rejected!',
                        response.message,
                        'success'
                    )
                    location.reload()
                }
            })
        })

        $('#incommingrequestworker-table')
            .on('processing.dt', function(e, settings, processing) {
                if (settings) {
                    $('#incommingrequestworker-table_processing').css('display', 'none')
                }
            })
    </script>
@endpush
