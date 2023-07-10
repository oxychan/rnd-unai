@extends('layouts.app')
@section('title', 'Permohonan')

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
                            <h3 class="card-label">Data Riwayat Permohonan
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a id="addRequestButton" name="addRequest" class="btn btn-primary font-weight-bolder btn-sm"
                                href="javascript:void(0)">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <!--end::Svg Icon-->
                                </span>+ Ajukan Baru</a>
                            </a>
                            <!--end::Button-->
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

    {{-- modal for add pengaduan data --}}
    <!--begin::Modal - Create App-->
    <div class="modal fade" id="modalCreateUpdateRequest" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-900px modal-dialog-scrollable">
            <!--begin::Modal content-->

            <!-- end::Modal content -->
        </div>
        <!--end::Modal dialog-->
    </div>

    {{-- end of modal for add pengaduan data --}}

    {{-- modal detail pengaduan --}}
    <div class="modal fade" id="modalDetailRequest" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px modal-dialog-scrollable">
            <!--begin::Modal content-->

            <!-- end::Modal content -->
        </div>
        <!--end::Modal dialog-->
    </div>
    {{-- end of modal detail pengaduan --}}

@endsection

@push('data_tables')
    {{ $dataTable->scripts() }}
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // modal instance
        const modalDetailRequest = new bootstrap.Modal($('#modalDetailRequest'))

        $('#userhistoryrequest-table').on('click', '#btnDetail', function() {
            let data = $(this).data()
            let id = data.id

            showDetail(id)
        })

        function showDetail(id) {
            $.ajax({
                method: 'GET',
                url: 'show/' + id,
                success: function(response) {
                    const modalDialog = $('#modalDetailRequest').find('.modal-dialog')
                    modalDialog.html(response)
                    modalDetailRequest.show()

                    edit(id)
                }
            })
        }

        $('#userhistoryrequest-table')
            .on('processing.dt', function(e, settings, processing) {
                if (settings) {
                    $('#userhistoryrequest-table_processing').css('display', 'none')
                }
            })
    </script>
@endpush
