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

    {{-- modal for forward to worker --}}
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 id="modal-judul" style="color: white">Tolak Permohonan</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body" id="actionRefuseTask">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pb-0">
                            <form id="formRejectTask" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Catatan</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5" id="refuse_note" name="refuse_note"
                                            placeholder="e.g: Load pekerjaan terlalu banyak" required></textarea>
                                    </div>
                                </div> <br>
                                <div class="form-group row justify-content-end">
                                    <div class="col-md-3">
                                        <input class="btn btn-primary" type="submit" id="btnSubmit" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!-- end::Modal content -->
        </div>
        <!--end::Modal dialog-->
    </div>
    {{-- end of modal forward to helpdesk --}}

@endsection

@push('data_tables')
    {{ $dataTable->scripts() }}
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const modalRefuseTask = new bootstrap.Modal($('#modalTolak'))

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

            console.log(id)
            modalRefuseTask.show()

            $('#formRejectTask').attr('action', 'reject/' + id)
        })

        $('#formRejectTask').on('submit', function(e) {
            e.preventDefault()

            const form = this
            const formData = new FormData(form)

            const url = this.getAttribute('action')
            console.log(url);

            $.ajax({
                method: 'POST',
                url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire(
                        'Refused!',
                        response.message,
                        'success'
                    )
                    modalRefuseTask.hide()
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
