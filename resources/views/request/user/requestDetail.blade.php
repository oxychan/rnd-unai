@php
    use Carbon\Carbon;
@endphp

<!--begin::Modal content-->
<div class="modal-content">
    <!--begin::Modal header-->
    <div class="modal-header">
        <!--begin::Modal title-->
        <h2 id="modal-judul" style="color: white">Detail Permohonan</h2>
        <!--end::Modal title-->
        <!--begin::Close-->
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
    <div class="modal-body" id="actionCreateUpdateModalBody">
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-1 fw-bold">{{ $currentReq->title }}</a>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <div class="py-5 fs-6">
                                    <div class="fw-bold mt-5 mb-2">Status Permohonan</div>
                                    <div>
                                        {!! setStatus($currentReq->status) !!}
                                    </div>
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
                                    <div class="text-gray-600">
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
                                    <span class="text-muted mt-1 fw-semibold fs-7">Daftar item permohonan yang
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
                                @if ($currentReq->status == 2 && $currentReq->is_revised)
                                    <div class="fw-bold mt-5 mb-2">Revisi</div>
                                    <div class="text-gray-600">
                                        <p>{{ $currentReq->revise_note }}</p>
                                    </div>
                                    <button class="btn btn-warning" id="btnRevise">Revisi</button>
                                @endif
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
        </div>
    </div>
    <!--end::Modal body-->
</div>
<!-- end::Modal content -->
