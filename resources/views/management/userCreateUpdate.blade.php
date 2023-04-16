{{-- modal body --}}
<!--begin::Modal content-->
<div class="modal-content">
    <!--begin::Modal header-->
    <div class="modal-header">
        <!--begin::Modal title-->
        <h2 id="modal-judul" style="color: white">{{ $user != null ? 'Edit User' : 'Add User' }}</h2>
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
        <form role="form" class="form" id="formCreateUpdateUser" name="formCreateUpdateUser"
            enctype="multipart/form-data" method="POST"
            action="{{ $user != null ? route('management.user.update', $user) : route('management.user.store') }}">
            @csrf
            @if ($user != null)
                @method('PUT')
            @endif
            <div class="modal-body" style="height: 300px;">
                <div class="mb-7">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="e.g: John Dypth" value="{{ $user->name ?? '' }}" required />
                            <span class="form-text text-muted">Please enter name</span>
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="e.g: john_dypth" value="{{ $user->username ?? '' }}" required />
                            <span class="form-text text-muted">Please enter username</span><br>
                            <span id="error_username"></span>
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="e.g: johndypth@gmail.com" value="{{ $user->email ?? '' }}" />
                            <span class="form-text text-muted">Please enter email</span>
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">User Role</label>
                        <div class="col-lg-9">
                            <select class="form-control select2" id="role" name="role" style="width: 100%;"
                                required>
                                <option value="">Choose Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        @if ($user != null) {{ $user->roles->pluck('name')[0] == $role->name ? 'selected' : '' }} @endif>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                            <span class="form-text text-muted">Please enter role</span>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Telp</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="telp" name="telp"
                                placeholder="e.g: 0882215551" value="{{ $user->telp ?? '' }}" />
                            <span class="form-text text-muted">Please enter phone number</span>
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary font-weight-bold">
                    <i class="fa fa-save"></i> {{ $user != null ? 'Save' : 'Create' }}
                </button>
            </div>
        </form>
        <!--end:Form-->

    </div>
    <!--end::Modal body-->
</div>
<!--end::Modal content-->
