@extends('layouts.app')
@section('title', 'Menu Management')

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
                            <h3 class="card-label">Data Menu
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a id="addMenuButton" name="addRole" class="btn btn-primary font-weight-bolder btn-sm"
                                href="javascript:void(0)">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <!--end::Svg Icon-->
                                </span>+ Tambah</a>
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

    {{-- modal for add and edit user data --}}
    <!--begin::Modal - Create App-->
    <div class="modal fade" id="modalCreateUpdate" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-900px modal-dialog-scrollable"></div>
        <!--end::Modal dialog-->
    </div>

    {{-- end of modal for add and edit user data --}}

@endsection

@push('data_tables')
    {{ $dataTable->scripts() }}
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // create instance modal
        const modalCreateUpdate = new bootstrap.Modal($('#modalCreateUpdate'))

        // add new user
        $('#addMenuButton').on('click', function() {
            $.ajax({
                method: 'GET',
                url: '{{ route('management.menu.create') }}',
                success: function(response) {
                    const modalDialog = $('#modalCreateUpdate').find('.modal-dialog')
                    modalDialog.html(response)
                    modalCreateUpdate.show()
                    store()
                }
            })

            function store() {
                $('#formCreateUpdateMenu').on('submit', function(e) {
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
                            Swal.fire(
                                'Added!',
                                'User berhasil ditambahkan.',
                                'success'
                            )
                            window.LaravelDataTables["menus-table"].ajax.reload()
                            modalCreateUpdate.hide()
                        }
                    })

                })
            }
        })

        $('#menus-table').on('click', '#editMenu', function() {
            let data = $(this).data()
            let id = data.id
            $.ajax({
                method: 'get',
                url: '/management/menu/' + id + '/edit',
                success: function(response) {
                    const modalDialog = $('#modalCreateUpdate').find('.modal-dialog')
                    modalDialog.html(response)
                    modalCreateUpdate.show()
                    isParent()
                    update(id)
                }
            })

            function update(userId) {
                $('#formCreateUpdateMenu').on('submit', function(e) {
                    e.preventDefault()
                    const form = this
                    const formData = new FormData(form)

                    const url = this.getAttribute('action')
                    console.log(url)

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
                                'Edited!',
                                'Data user berhasil diedit.',
                                'success'
                            )
                            window.LaravelDataTables["menus-table"].ajax.reload()
                            modalCreateUpdate.hide()
                        }
                    })

                })
            }

            function isParent() {
                if ($('#addParentMenuCheckbox').is(':checked')) {
                    $('#isRoot').hide()
                    $('#root').removeAttr('required')
                    $('#root').val(null)
                }
            }
        })

        $('#menus-table').on('click', '#deleteMenu', function() {
            let data = $(this).data()
            let id = data.id
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: '/management/menu/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'User berhasil dihapus.',
                                'success'
                            )
                            window.LaravelDataTables["menus-table"].ajax.reload()
                        }
                    })

                }
            })
        })


        $('#menus-table')
            .on('processing.dt', function(e, settings, processing) {
                if (settings) {
                    $('#menus-table_processing').css('display', 'none')
                }
            })

        $('#modalCreateUpdate').on('click', '#addParentMenuCheckbox', function() {
            if ($(this).is(':checked')) {
                $('#isRoot').hide()
                $('#root').removeAttr('required')
                $('#root').val(null)
            } else {
                $('#isRoot').show()
            }
        });
    </script>
@endpush
