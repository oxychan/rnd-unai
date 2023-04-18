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
        <div class="modal-dialog modal-dialog-centered mw-500px modal-dialog-scrollable">
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
        const modalCreateUpdateRequest = new bootstrap.Modal($('#modalCreateUpdateRequest'))
        const modalDetailRequest = new bootstrap.Modal($('#modalDetailRequest'))

        // add new req
        $('#addRequestButton').on('click', function() {
            $.ajax({
                method: 'GET',
                url: '{{ route('permohonan.user.create') }}',
                success: function(response) {
                    const modalDialog = $('#modalCreateUpdateRequest').find('.modal-dialog')
                    modalDialog.html(response)
                    modalCreateUpdateRequest.show()

                    addNewItems()
                    submitForm()
                    onFormSubmited()
                }
            })

            function addNewItems() {
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
                })
            }

            function submitForm() {
                // kirim btn submitted
                $('#submitBtn').on('click', function() {
                    $('#formRequest').submit()
                })
            }

            function onFormSubmited() {
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
            }

            function addItems(id) {
                $('#formRequestList').on('submit', function(e) {
                    e.preventDefault()

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
                            modalCreateUpdateRequest.hide()
                            form.reset()
                        }
                    })
                })
            }
        })

        $('#userrequest-table').on('click', '#btnDetail', function() {
            let data = $(this).data()
            let id = data.id

            showDetail(id)
        })

        function showDetail(id) {
            $.ajax({
                method: 'GET',
                url: 'user/show/' + id,
                success: function(response) {
                    const modalDialog = $('#modalDetailRequest').find('.modal-dialog')
                    modalDialog.html(response)
                    modalDetailRequest.show()

                    edit(id)
                }
            })

            function edit(id) {
                $('#btnRevise').on('click', function() {
                    $.ajax({
                        method: 'GET',
                        url: 'user/edit/' + id,
                        success: function(response) {
                            modalDetailRequest.hide()

                            const modalDialog = $('#modalCreateUpdateRequest').find('.modal-dialog')
                            modalDialog.html(response)

                            modalCreateUpdateRequest.show()

                            $('#submitBtn').on('click', function() {
                                $('#formRequest').submit()
                            })

                            update()
                        }
                    })
                })
            }

            function update(id) {
                $('#formRequest').on('submit', function(e) {
                    e.preventDefault()

                    const form = this
                    const formData = new FormData(form)
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
                            updateItems(response.request_id)
                            $('#formRequestList').submit()
                            form.reset()
                        }
                    })
                })
            }

            function updateItems(id) {
                console.log('updated items');
                $('#formRequestList').on('submit', function(e) {
                    e.preventDefault()

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
                                'Permohonan berhasil diperbarui.',
                                'success'
                            )
                            window.LaravelDataTables["userrequest-table"].ajax.reload()
                            modalCreateUpdateRequest.hide()
                            form.reset()
                        }
                    })
                })
            }
        }

        $('#userrequest-table')
            .on('processing.dt', function(e, settings, processing) {
                if (settings) {
                    $('#userrequest-table_processing').css('display', 'none')
                }
            })
    </script>
@endpush
