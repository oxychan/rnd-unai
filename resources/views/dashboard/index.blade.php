@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="row g-5 g-xl-10 mb-2 mb-xl-2">
        <!--begin::Col-->
        <div class="col-xxl-6">
            <!--begin::Engage widget 10-->
            <div class="card card-flush" style="background-color: #3C549F; height: 160px;">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-8">
                            <h1 class="text-light">Selamat Datang,</h1>
                            <h1 class="text-light">{{ $data['name'] ?? '' }}</h1>
                        </div>
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/media/illustrations/airo/pose1.png') }}" alt="pose"
                                style="width: 80px">
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 10-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 20-->
            <div class="card card-flush" style="height: 160px;">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <span id="hari">Senin</span>
                        <!--end::Amount-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end">
                    <!--begin::Progress-->
                    <h1 id="tanggal">01 Januari 0000</h1>
                    <!--end::Progress-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 17-->
            <div class="card card-flush" style="background-color: #3C549F; height: 160px;">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-wrap align-items-center">
                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <h1 class="text-center text-light" style="font-size: 42pt;" id="jam">00:00</h1>
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 17-->
        </div>
        <!--end::Col-->
    </div>

    <div class="row g-5 g-xl-10 mb-2">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 20-->
            <div class="card card-flush mb-5" style="height: 160px;">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex">
                        @hasrole('admin')
                            <i class="fa-solid fa-user" style="color: #7239EA"></i>
                        @else
                            {!! setStatus(0) !!}
                        @endhasrole
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end">
                    <div class="col">
                        @hasrole('admin')
                            <h1>{{ $data['jumlah_user'] }}</h1>
                            <h5>Jumlah User</h5>
                        @else
                            <h1>{{ $data['diajukan'] }}</h1>
                            <h5>Diajukan</h5>
                        @endhasrole
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
            <!--begin::Card widget 20-->
            <div class="card card-flush mb-5" style="height: 160px;">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex">
                        @hasrole('admin')
                            <i class="fa-solid fa-comments" style="color: #7239EA"></i>
                        @else
                            {!! setStatus(3) !!}
                        @endhasrole
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end">
                    <div class="col">
                        @hasrole('admin')
                            <h1>{{ $data['jumlah_jenis_permohonan'] }}</h1>
                            <h5>Jenis Permohonan</h5>
                        @else
                            <h1>{{ $data['selesai'] }}</h1>
                            <h5>Selesai</h5>
                        @endhasrole
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 20-->
            <div class="card card-flush mb-5" style="height: 160px;">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex">
                        @hasrole('admin')
                            <i class="fa-solid fa-users" style="color: #7239EA"></i>
                        @else
                            {!! setStatus(1) !!}
                        @endhasrole
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end">
                    <div class="col">
                        @hasrole('admin')
                            <h1>{{ $data['jumlah_role'] }}</h1>
                            <h5>Jumlah Role</h5>
                        @else
                            <h1>{{ $data['diproses'] }}</h1>
                            <h5>Diproses</h5>
                        @endhasrole
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
            <!--begin::Card widget 20-->
            @hasanyrole('admin|user|helpdesk')
                <div class="card card-flush mb-5" style="height: 160px;">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex">
                            @hasrole('admin')
                                <i class="fa-solid fa-list" style="color: #7239EA"></i>
                            @else
                                {!! setStatus(2) !!}
                            @endhasrole
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end">
                        <div class="col">
                            @hasrole('admin')
                                <h1>{{ $data['jumlah_menu'] }}</h1>
                                <h5>Jumlah Menu</h5>
                            @else
                                <h1>{{ $data['ditolak'] ?? '' }}</h1>
                                <h5>Ditolak</h5>
                            @endhasrole
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            @endhasanyrole
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-6">
            <!--begin::Engage widget 10-->
            <div class="card card-flush" style="height: 335px;">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('assets/media/illustrations/airo/pose5.png') }}" alt="pose"
                        style="width: 220px;">
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 10-->
        </div>
        <!--end::Col-->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateTime() {
                var now = new Date();
                var dayOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now.getDay()];
                var date = now.getDate();
                var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ][now.getMonth()];
                var year = now.getFullYear();
                var hours = ('0' + now.getHours()).slice(-2);
                var minutes = ('0' + now.getMinutes()).slice(-2);
                var formattedDate = date + ' ' + month + ' ' + year;

                $('#hari').text(dayOfWeek);
                $('#tanggal').text(formattedDate);
                $('#jam').text(hours + ':' + minutes);
            }

            setInterval(updateTime, 1000);
        });
    </script>
@endpush
