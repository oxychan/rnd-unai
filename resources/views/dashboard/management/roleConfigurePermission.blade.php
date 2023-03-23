<div class="modal-content">
    <!--begin::Modal header-->
    <div class="modal-header">
        <!--begin::Modal title-->
        <h2 class="fw-bold">Edit Hak Akses</h2>
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
    <div class="modal-body scroll-y mx-5 my-7">
        <!--begin::Form-->
        <form id="formUpdatePermission" class="form" action="{{ route('management.role.updatePermission', $role) }}">
            @csrf
            @method('PUT')
            <!--begin::Scroll-->
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_update_role_header"
                data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fs-5 fw-bold form-label mb-2">
                        <span class="required">NAMA ROLE:</span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-solid" name="name" value="{{ $role->name ?? '' }}" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Permissions-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                    <!--end::Label-->
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-semibold">
                                <!--begin::Table row-->
                                @foreach ($menus as $menu)
                                    @if ($menu->root != null || ($menu->root == null && $menu->subMenus->count() <= 0))
                                        <tr>
                                            <!--begin::Label-->
                                            <td class="text-gray-800">{{ $menu->nama }}</td>
                                            <!--end::Label-->
                                            <!--begin::Input group-->
                                            <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox" value="true"
                                                            name="{{ $menu->nama }}_read"
                                                            @if ($role->hasPermissionTo("read $menu->url")) checked @endif />
                                                        <span class="form-check-label">Read</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox" value="true"
                                                            name="{{ $menu->nama }}_update"
                                                            @if ($role->hasPermissionTo("update $menu->url")) checked @endif />
                                                        <span class="form-check-label">Update</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox" value="true"
                                                            name="{{ $menu->nama }}_create"
                                                            @if ($role->hasPermissionTo("create $menu->url")) checked @endif />
                                                        <span class="form-check-label">Create</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="true"
                                                            name="{{ $menu->nama }}_delete"
                                                            @if ($role->hasPermissionTo("delete $menu->url")) checked @endif />
                                                        <span class="form-check-label">Delete</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            <!--end::Input group-->
                                        </tr>
                                    @endif
                                @endforeach


                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table wrapper-->
                </div>
                <!--end::Permissions-->
            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Modal body-->
</div>
