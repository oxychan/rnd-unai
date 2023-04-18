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
    <div class="modal-body py-lg-10 px-lg-10" id="actionCreateUpdateModalBody">
        <!--begin:Form-->
        <form role="form" class="form" id="formRequest" name="formRequest" enctype="multipart/form-data"
            method="POST"
            action="{{ $currentReq != null ? route('permohonan.user.update', ['id' => $currentReq->id]) : route('permohonan.user.store') }}">
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
                                    <option value="{{ $type->id }}"
                                        {{ $currentReq != null && $type->id == $currentReq->type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Judul</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $currentReq != null ? $currentReq->title : '' }}"
                                placeholder="e.g: Komputer tidak bisa nyala" required />
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Deskripsi</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="3" id="description" name="description"
                                placeholder="e.g: Komputer saat dinyalakan mati sendiri" required>{{ $currentReq != null ? $currentReq->description : '' }}</textarea>
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">No. Telp (kontak)</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" id="telp" name="telp"
                                value="{{ $currentReq != null ? $currentReq->telp : '' }}" required />
                            <span class="form-text text-muted">Tolong masukkan nomor yang bisa
                                dihubungi</span>
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">File Upload</label>
                        <div class="col-lg-9">
                            <input type="file" class="form-control" name="file" id="file" accept="pdf" />
                            <span class="form-text text-muted">Hanya pdf</span>
                        </div>
                    </div><br>
                </div>
            </div>
        </form>
        <!--end:Form-->
        <div class="separator my-2"></div>
        <!--begin:Form item-->
        <form role="form" class="form" id="formRequestList" name="formRequestList" enctype="multipart/form-data"
            method="POST">
            @csrf
            @if ($currentReq != null)
                @method('PUT')
            @endif
            <div class="modal-body">
                <div class="row mb-7">
                    <div class="col-lg-10">
                        <h3 class="card-label">List Permohonan
                            <span class="d-block text-muted pt-2 font-size-sm"></span>
                        </h3>
                    </div>
                    @if ($currentReq == null)
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
                    @endif
                </div>
                <div class="mb-7" id="listRequestParent">
                    @if ($currentReq == null)
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
                    @else
                        @foreach ($currentReq->items as $item)
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Subyek</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="subject" name="subject[]"
                                        value="{{ $item->subject }}" placeholder="e.g: Komputer" required />
                                </div>
                            </div> <br>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Deskripsi</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" rows="3" id="description" name="description[]" placeholder="e.g: Berasap"
                                        required>{{ $item->description }}</textarea>
                                </div>
                            </div> <br>
                        @endforeach
                    @endif
                </div>
            </div>
        </form>
        <div class="modal-footer">
            <button type="submit" id="submitBtn" value="create" class="btn btn-primary font-weight-bold">
                {{ $currentReq != null ? 'Update' : 'Kirim' }}
            </button>
        </div>
        <!--end:Form item-->
    </div>
    <!--end::Modal body-->
</div>
<!-- end::Modal content -->
