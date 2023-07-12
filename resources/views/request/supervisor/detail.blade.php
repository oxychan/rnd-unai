@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')
@section('title', 'Permohonan Detail')

@push('additional_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="content" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card mb-2" style="max-height: 150px">
                    <div class="card-body py-4">
                        <div class="row justify-content-start">
                            <div class="col-md-2">
                                <img src="{{ asset('assets/media/avatars/' . $currentReq->user->avatar) }}"
                                    class="w-100px rounded">
                            </div>
                            <div class="col-md-4">
                                <div class="row mb-2">
                                    <h4>
                                        {{ $currentReq->user->name }}
                                    </h4>
                                </div>
                                <div class="row">
                                    <span class="fs-6">
                                        {{ Carbon::parse($currentReq->created_at)->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    @if ($currentReq->is_duplicated)
                        <div class='badge badge-light-info fw-bold'>Data diduplikasi</div>
                    @elseif ($currentReq->is_data_duplicate)
                        <div class='badge badge-light-info fw-bold'>Data duplikat</div>
                    @endif
                    <!--begin::Body-->
                    <div class="card-body py-12">
                        <div class="card card-flush h-xl-100">
                            <!--begin::Body-->
                            <div class="card-body pt-6">
                                <!--begin::Nav-->
                                <ul class="nav nav-pills nav-pills-custom mb-3 justify-content-center" role="tablist">
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-outline btn-flex btn-color-muted flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active"
                                            id="kt_stats_widget_16_tab_link_1" data-bs-toggle="pill"
                                            href="#kt_stats_widget_16_tab_1" aria-selected="true" role="tab">
                                            @if ($currentReq->id_user != null)
                                                <div class="symbol symbol-50px mb-1">
                                                    <img
                                                        src="{{ asset('assets/media/avatars/' . $currentReq->user->avatar) }}">
                                                </div>
                                            @else
                                                <div class="nav-icon mb-3">
                                                    <i class="fa-solid fa-user fs-1 p-0"></i>
                                                </div>
                                            @endif
                                            <!--begin::Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">User</span>
                                            <!--end::Title-->
                                            <!--begin::Bullet-->
                                            <span
                                                class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn   btn-outline btn-flex btn-color-muted flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                            id="kt_stats_widget_16_tab_link_2" data-bs-toggle="pill"
                                            href="#kt_stats_widget_16_tab_2" aria-selected="false" tabindex="-1"
                                            role="tab">
                                            @if ($currentReq->id_helpdesk)
                                                <div class="symbol symbol-50px mb-1">
                                                    <img
                                                        src="{{ asset('assets/media/avatars/' . $currentReq->helpdesk->avatar) }}">
                                                </div>
                                            @else
                                                <div class="nav-icon mb-3">
                                                    <i class="fa-solid fa-window-restore fs-1 p-0"></i>
                                                </div>
                                            @endif
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Helpdesk</span>
                                            <!--end::Title-->
                                            <!--begin::Bullet-->
                                            <span
                                                class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-outline btn-flex btn-color-muted flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                            id="kt_stats_widget_16_tab_link_3" data-bs-toggle="pill"
                                            href="#kt_stats_widget_16_tab_3" aria-selected="false" tabindex="-1"
                                            role="tab">
                                            <!--begin::Icon-->
                                            {{-- <div class="symbol symbol-50px mb-1">
                                                <img src="{{ asset('assets/media/avatars/default.jpg') }}">
                                            </div> --}}
                                            @if ($currentReq->id_spv)
                                                <div class="symbol symbol-50px mb-1">
                                                    <img
                                                        src="{{ asset('assets/media/avatars/' . $currentReq->spv->avatar) }}">
                                                </div>
                                            @else
                                                <div class="nav-icon mb-3">
                                                    <i class="fa-solid fa-address-card fs-1 p-0"></i>
                                                </div>
                                            @endif

                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">SPV</span>
                                            <!--end::Title-->
                                            <!--begin::Bullet-->
                                            <span
                                                class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-outline btn-flex btn-color-muted flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                            id="kt_stats_widget_16_tab_link_4" data-bs-toggle="pill"
                                            href="#kt_stats_widget_16_tab_4" aria-selected="false" tabindex="-1"
                                            role="tab">
                                            <!--begin::Icon-->
                                            {{-- <div class="symbol symbol-50px mb-1">
                                                <img src="{{ asset('assets/media/avatars/default.jpg') }}">
                                            </div> --}}
                                            <div class="nav-icon mb-3">
                                                <i class="fa-solid fa-briefcase fs-1 p-0"></i>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Worker</span>
                                            <!--end::Title-->
                                            <!--begin::Bullet-->
                                            <span
                                                class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-outline btn-flex btn-color-muted flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                            id="kt_stats_widget_16_tab_link_5" data-bs-toggle="pill"
                                            href="#kt_stats_widget_16_tab_5" aria-selected="false" tabindex="-1"
                                            role="tab">
                                            <!--begin::Icon-->
                                            <div class="nav-icon mb-3">
                                                @if ($currentReq->status == 3)
                                                    <i class="fa-solid fa-check-circle fs-1 p-0" style="color: green;"></i>
                                                @else
                                                    <i class="fa-solid fa-check-circle fs-1 p-0"></i>
                                                @endif
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Selesai</span>
                                            <!--end::Title-->
                                            <!--begin::Bullet-->
                                            <span
                                                class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Nav-->
                                <!--begin::Tab Content-->
                                <div class="tab-content">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1" role="tabpanel"
                                        aria-labelledby="#kt_stats_widget_16_tab_link_1">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack px-4 rounded"
                                            style="border-style: solid;">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <div class="py-5 fs-6">
                                                    <!--begin::Details item-->
                                                    <div class="fw-bold mt-5 mb-2">Tanggal Pengajuan</div>
                                                    <div class="text-gray-600">
                                                        {{ Carbon::parse($currentReq->created_at)->format('d M Y') }}
                                                    </div>

                                                    <div class="fw-bold mt-5 mb-2">Jenis Permohonan</div>
                                                    <div class="text-gray-600">
                                                        {{ $currentReq->type->name }}
                                                    </div>

                                                    <div class="fw-bold mt-5 mb-2">Deskripsi</div>
                                                    <div class="text-gray-600" style="max-width: 800px;">
                                                        <p>{{ $currentReq->description }}</p>
                                                    </div>

                                                    <div class="fw-bold mt-5 mb-2">File</div>
                                                    <div class="text-gray-600">
                                                        @if ($currentReq->file_name)
                                                            <a
                                                                href="{{ asset('assets/media/files/permohonan/' . $currentReq->file_name) }}">Lihat</a>
                                                        @else
                                                            <p>Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="separator my-2"></div>
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bold mt-5 mb-2 fs-6">List Permohonan</div>
                                                    <span class="text-muted mt-1 fw-semibold fs-7">Daftar item permohonan
                                                        yang
                                                        diajukan</span>
                                                    <div class="mt-5">
                                                        <div class="table-responsive">
                                                            <!--begin::Table-->
                                                            <table class="table">
                                                                <!--begin::Table head-->
                                                                <thead>
                                                                    <tr class="fw-bold text-muted bg-light">
                                                                        <th class="ps-4 rounded-start">No</th>
                                                                        <th>Suyek</th>
                                                                        <th class="pe-4 rounded-end">Deskripsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <!--end::Table head-->
                                                                <!--begin::Table body-->
                                                                <tbody>
                                                                    @foreach ($currentReq->items as $index => $item)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div
                                                                                        class="d-flex justify-content-start flex-column ps-4">
                                                                                        <span
                                                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                                            {{ ++$index }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div
                                                                                        class="d-flex justify-content-start flex-column">
                                                                                        <span
                                                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                                            {{ $item->subject }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div
                                                                                        class="d-flex justify-content-start flex-column">
                                                                                        <span
                                                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                                            {{ $item->description }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane helpdesk-->
                                    <div class="tab-pane fade" id="kt_stats_widget_16_tab_2" role="tabpanel"
                                        aria-labelledby="#kt_stats_widget_16_tab_link_2">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack px-4 rounded"
                                            style="{{ $currentReq->id_helpdesk ? 'border-style: solid;' : '' }}">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <div class="d-flex justify-content-center">
                                                    <h4 class="fs-4 my-4">Task diteruskan oleh
                                                        {{ $currentReq->helpdesk->name }}</h4>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane spv-->
                                    <div class="tab-pane fade" id="kt_stats_widget_16_tab_3" role="tabpanel"
                                        aria-labelledby="#kt_stats_widget_16_tab_link_3">
                                        <!--begin::Stats-->
                                        <div class="d-flex justify-content-end my-5">
                                            <button class="btn btn-secondary mx-2" id="btnPembobotan"
                                                {{ $currentReq->id_worker || $currentReq->status == 3 ? 'disabled' : '' }}>Pembobotan</button>
                                            <button class="btn btn-primary mx-2" id="btnForward" type="button"
                                                {{ $currentReq->id_worker || $currentReq->status == 3 ? 'disabled' : '' }}>Teruskan</button>
                                        </div>

                                        @if ($currentReq->refuse_note)
                                            <div class="d-flex flex-wrap flex-stack px-4 rounded"
                                                style="border-style: solid; border-color: yellow;">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                                    <div class="py-5 fs-6">
                                                        <div class="fw-bold mt-5 mb-2">Tanggal Worker Menolak</div>
                                                        <div class="text-gray-600">
                                                            {{ Carbon::parse($currentReq->updated_at)->format('d M Y') }}
                                                        </div>
                                                        <div class="fw-bold mt-5 mb-2">Catatan</div>
                                                        <div class="text-gray-600">
                                                            {{ $currentReq->refuse_note }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                        @endif

                                        <div class="d-flex flex-wrap flex-stack px-4 mt-4 rounded"
                                            style="border-style: solid;">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <form action="{{ route('permohonan.spv.close', $currentReq->id) }}"
                                                    id="formCloseTask" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label class="col-form-label">Catatan</label>
                                                        <textarea class="form-control" rows="5" id="close_note" name="close_note"
                                                            placeholder="e.g: Task terselesaikan dengan ...." required></textarea>
                                                    </div> <br>
                                                    <div class="row justify-content-end">
                                                        <button class="btn btn-success col-md-2" type="submit"
                                                            id="btnSubmitCloseTask"
                                                            {{ $currentReq->id_worker || $currentReq->status == 3 ? 'disabled' : '' }}>Tutup
                                                            Task</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_stats_widget_16_tab_4" role="tabpanel"
                                        aria-labelledby="#kt_stats_widget_16_tab_link_4">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack px-4 rounded"
                                            style="border-style: solid;">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                @if ($currentReq->id_worker && $currentReq->is_worker_approved == 0)
                                                    <div class="d-flex justify-content-center">
                                                        <h4 class="fs-4 my-4">Menunggu persetujuan worker!</h4>
                                                    </div>
                                                @elseif ($currentReq->id_worker == null)
                                                    <div class="d-flex justify-content-center">
                                                        <h4 class="fs-4 my-4">Worker belum melakukan disposisi!</h4>
                                                    </div>
                                                @elseif ($currentReq->id_worker && $currentReq->is_worker_approved == 1)
                                                    <div class="d-flex justify-content-center">
                                                        <h4 class="fs-4 my-4">Task didisposisi oleh
                                                            {{ $currentReq->spv->name }}</h4>
                                                    </div>
                                                @endif
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--start::Tap pane-->
                                    <div class="tab-pane fade" id="kt_stats_widget_16_tab_5" role="tabpanel"
                                        aria-labelledby="#kt_stats_widget_16_tab_link_5">
                                        <div class="d-flex flex-wrap flex-stack px-4 rounded"
                                            style="border-style: solid;">
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <div class="d-flex justify-content-center">
                                                    <h4 class="fs-4 my-4">Permohonan belum selesai!</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tab Content-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

    {{-- modal for forward to worker --}}
    <div class="modal fade" id="modalForwardToWorker" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 id="modal-judul" style="color: white">Teruskan ke Worker</h2>
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
                <div class="modal-body" id="actionForwardToSpv">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pb-0">
                            <form action="{{ route('permohonan.spv.forward', $currentReq->id) }}"
                                id="formForwardToWorker" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Pilih Worker</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select2" id="worker" name="worker"
                                            style="width: 100%;" required>
                                            <option value="">Choose worker</option>
                                            @foreach ($workers as $worker)
                                                <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Please choose worker</span>
                                    </div>
                                </div> <br>
                                <div class="form-group row justify-content-end">
                                    <div class="col-md-3">
                                        <input class="btn btn-primary" type="submit" id="btnSubmitHelpdesk"
                                            value="Teruskan" />
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

    {{-- modal for forward to worker --}}
    <div class="modal fade" id="modalPembobotan" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 id="modal-judul" style="color: white">Pembobotan</h2>
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
                <div class="modal-body" id="actionForwardToSpv">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pb-0">
                            <form action="{{ route('permohonan.spv.weight', $currentReq->id) }}" id="formPembobotan"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Pilih Bobot(prioritas)</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select2" id="weight" name="weight"
                                            style="width: 100%;" required>
                                            <option value="">Choose weight</option>
                                            @foreach ($weights as $weight)
                                                <option value="{{ $weight->id }}">{{ $weight->title }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Please choose weight</span>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // create instance modal
        const modalForwardToWorker = new bootstrap.Modal($('#modalForwardToWorker'))
        const modalWeight = new bootstrap.Modal($('#modalPembobotan'))

        $('#formForwardToWorker').on('submit', function(e) {
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
                        'Forwarded!',
                        response.message,
                        'success'
                    )
                    location.reload()
                }
            })
        })

        $('#formCloseTask').on('submit', function(e) {
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
                        'Closed!',
                        response.message,
                        'success'
                    )
                    window.location.href = '/permohonan/spv/selesai'
                }
            })

        })

        $('#formPembobotan').on('submit', function(e) {
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
                        'Updated!',
                        response.message,
                        'success'
                    )
                    location.reload()
                }
            })

        })

        $('#btnForward').on('click', function() {
            modalForwardToWorker.show()
        })

        $('#btnPembobotan').on('click', function() {
            modalWeight.show()
        })
    </script>
@endpush
