<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="/">
            <img alt="Logo" src="{{ asset('') }}assets/media/logos/logo-removebg.png"
                class="h-100px w-150px app-sidebar-logo-default" />
            {{-- <img alt="Logo" src="assets/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="assets/media/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" /> --}}
        </a>
        <!--end::Logo image-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                @foreach (getMenus() as $menu)
                    @can('read ' . $menu->url)
                        <div data-kt-menu-trigger="click"
                            class="menu-item {{ $menu->subMenus->count() > 0 ? 'menu-accordion' : '' }} {{ isParentExpanded($menu->url) ? 'here show' : '' }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="{{ $menu->icon }}"></i>
                                </span>
                                <span class="menu-title">{{ $menu->nama }}</span>
                                @if ($menu->subMenus->count() > 0)
                                    <span class="menu-arrow"></span>
                                @endif
                            </span>
                            @if ($menu->subMenus->count() > 0)
                                <div class="menu-sub menu-sub-accordion">
                                    @foreach ($menu->subMenus as $subMenu)
                                        @can('read ' . $subMenu->url)
                                            <div class="menu-item">
                                                <a class="menu-link {{ url()->current() == url($subMenu->url) ? 'active' : '' }}"
                                                    href="{{ $subMenu->url }}">
                                                    <span class="menu-icon">
                                                        <i class="{{ $subMenu->icon }}"></i>
                                                    </span>
                                                    <span class="menu-title">{{ $subMenu->nama }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endcan
                @endforeach
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <form method="POST" action="{{ route('auth.logout') }}" id="frmLogoutSidebar">
            @csrf
            <a id="btnLogoutSidebar"
                class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
                <span class="text-danger">Logout</span>
            </a>
        </form>
    </div>
    <!--end::Footer-->
</div>

@push('scripts')
    <script>
        $('#btnLogoutSidebar').click(function(e) {
            e.preventDefault();
            $('#frmLogoutSidebar').submit();
        });
    </script>
@endpush
