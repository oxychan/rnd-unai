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
                            <h3 class="card-label">Data Permohonan Saya
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
    <div class="modal fade" id="modalCreaRequest" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-900px modal-dialog-scrollable">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 id="modal-judul" style="color: white">Ajukan Permohonan</h2>
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
                <div class="modal-body py-lg-10 px-lg-10" id="actionCreateUpdateModalBody">
                    <!--begin:Form-->
                    <form role="form" class="form" id="formRequest" name="formRequest" enctype="multipart/form-data"
                        method="POST" action="{{ route('permohonan.user.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-7">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Jenis Pengaduan</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select2" id="request_type" name="request_type"
                                            style="width: 100%;" required>
                                            <option value="">Pilih jenis pengaduan</option>
                                            @foreach ($requestTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Judul</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="e.g: Komputer tidak bisa nyala" required />
                                    </div>
                                </div> <br>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Deskripsi</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="3" id="description" name="description"
                                            placeholder="e.g: Komputer saat dinyalakan mati sendiri" required></textarea>
                                    </div>
                                </div> <br>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">No. Telp (kontak)</label>
                                    <div class="col-lg-9">
                                        <input type="number" class="form-control" id="telp" name="telp"
                                            required />
                                        <span class="form-text text-muted">Tolong masukkan nomor yang bisa dihubungi</span>
                                    </div>
                                </div> <br>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">File Upload</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="file" id="file"
                                            accept="pdf" />
                                        <span class="form-text text-muted">Hanya pdf</span>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                    </form>
                    <!--end:Form-->
                    <div class="separator my-2"></div>
                    <!--begin:Form item-->
                    <form role="form" class="form" id="formRequestList" name="formRequestList"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-7">
                                <div class="col-lg-10">
                                    <h3 class="card-label">List Permohonan
                                        <span class="d-block text-muted pt-2 font-size-sm"></span>
                                    </h3>
                                </div>
                                <div class="col-lg-2">
                                    <!--begin::Button-->
                                    <a id="addItemsButton" name="addItems" class="btn btn-info font-weight-bolder btn-sm"
                                        href="javascript:void(0)">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                            <!--end::Svg Icon-->
                                        </span>Tambah</a>
                                    </a>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <div class="mb-7" id="listRequestParent">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Subyek</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="subject" name="subject[]"
                                            placeholder="e.g: Komputer" required />
                                    </div>
                                </div> <br>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Deskripsi</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="3" id="description" name="description[]" placeholder="e.g: Berasap"
                                            required></textarea>
                                    </div>
                                </div> <br>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="submit" id="submitBtn" value="create" class="btn btn-primary font-weight-bold">
                            Kirim
                        </button>
                    </div>
                    <!--end:Form item-->
                </div>
                <!--end::Modal body-->
            </div>
            <!-- end::Modal content -->
        </div>
        <!--end::Modal dialog-->
    </div>

    {{-- end of modal for add pengaduan data --}}

@endsection

@push('data_tables')
    {{ $dataTable->scripts() }}
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // modal instance
        const modalCreateRequest = new bootstrap.Modal($('#modalCreaRequest'))

        // define form


        // add new req
        $('#addRequestButton').on('click', function() {
            modalCreateRequest.show()
        })

        // Add new row when button is clicked
        $('#addItemsButton').click(function() {
            var newRow = '<div class="separator  mb-7"></div>' +
                '<div class="form-group row">' +
                '<label class="col-lg-3 col-form-label">Subyek</label>' +
                '<div class="col-lg-9">' +
                '<input type="text" class="form-control" id="subject" name="subject[]" placeholder="e.g: Komputer" required />' +
                '</div>' +
                '</div> <br>' +
                '<div class="form-group row">' +
                '  <label class="col-lg-3 col-form-label">Deskripsi</label>' +
                '<div class="col-lg-9">' +
                '<textarea class="form-control" rows="3" id="description" name="description[]" placeholder="e.g: Berasap" required></textarea>' +
                ' </div>' +
                '</div> <br>';

            $('#listRequestParent').append(newRow);
        });

        $('#userrequest-table')
            .on('processing.dt', function(e, settings, processing) {
                if (settings) {
                    $('#userrequest-table_processing').css('display', 'none')
                }
            })

        // kirim btn submitted
        $('#submitBtn').on('click', function() {
            $('#formRequest').submit()
        })

        $('#formRequest').on('submit', function(e) {
            e.preventDefault()
            const formReq = this
            const formData = new FormData(formReq)
            const url = this.getAttribute('action')

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
                    addItems(response.request_id)
                    $('#formRequestList').submit()
                    formReq.reset()
                }
            })
        })

        function addItems(id) {
            $('#formRequestList').on('submit', function(e) {
                e.preventDefault()

                console.log('on submit dijalankan');

                const form = this
                const formDataItems = new FormData(form)

                $.ajax({
                    method: 'POST',
                    url: 'user/items/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    data: formDataItems,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire(
                            'Added!',
                            'Permohonan berhasil dikirimkan.',
                            'success'
                        )
                        window.LaravelDataTables["userrequest-table"].ajax.reload()
                        modalCreateRequest.hide()
                        form.reset()
                    }
                })
            })
        }
    </script>
@endpush
