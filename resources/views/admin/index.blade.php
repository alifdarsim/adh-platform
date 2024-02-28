@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Welcome, {{auth()->user()->name}}</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to AsiaDealHub Dashboard, your one-stop dashboard to monitor all activity of AsiaDealHub
                        system</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="tw-grid tw-grid-cols-4 tw-gap-x-4">
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Total Projects</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left"
                            aria-label="Total active subscription" data-bs-original-title="Total number project">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data">
                        <span class="tw-text-4xl text-dark" id="total_project">-</span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Total Users</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left"
                            aria-label="Total active subscription" data-bs-original-title="Total registered users and admins">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data">
                        <span class="tw-text-4xl text-dark" id="total_user">-</span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">LinkedIn Experts</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left"
                            aria-label="Total active subscription" data-bs-original-title="Total LinkedIn Expert that scraped">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data"><span class="tw-text-4xl text-dark" id="total_experts">-</span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Total Clients</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left"
                            aria-label="Total active subscription" data-bs-original-title="Total Client">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data"><span class="tw-text-4xl text-dark" id="total_clients">-</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-grid tw-grid-cols-4 tw-gap-x-4 tw-mt-4">
            <div class="card card-bordered card-full tw-col-span-2">
                <div class="card-inner-group">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Active Project & Status</h6>
                            </div>
                            <div class="card-tools">
                                <a href="{{route('admin.projects.index')}}" class="link">View All</a>
                            </div>
                        </div>
                    </div>
                    <div id="latest_projects">
                        <div class="card-inner card-inner-md">
                            <div class="user-card mx-auto center tw-items-center">
                                <div class="user-info">
                                        <span class="tw-text-slate-600 tw-items-center center mx-auto">
                                            <span>You don't have any projects yet</span>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-2">
                        <div class="card-title">
                            <h6 class="title">Projects by Hub</h6>
                        </div>
                    </div>
                    <ul class="tw-grid tw-gap-y-4">
                        <li class="d-flex justify-between">
                            <div class="info">
                                <div class="fs-13px text-muted">Partner</div>
                                <div class="fs-20px text-dark" id="hub_partner">0</div>
                            </div>
                            <div class="bg-info-dim round-lg center tw-w-[55px]">
                                <i class="fa-regular fa-handshake text-info fs-4 px-2"></i>
                            </div>
                        </li>
                        <li class="d-flex justify-between">
                            <div class="info">
                                <div class="fs-13px text-muted">M&A</div>
                                <div class="fs-20px text-dark" id="hub_mna">0</div>
                            </div>
                            <div class="bg-success-dim round-lg center tw-w-[55px]">
                                <i class="fa-regular fa-merge text-success fs-4 px-2"></i>
                            </div>
                        </li>
                        <li class="d-flex justify-between">
                            <div class="info">
                                <div class="fs-13px text-muted">Marketing</div>
                                <div class="fs-20px text-dark" id="hub_marketing">0</div>
                            </div>
                            <div class="tw-bg-pink-100 round-lg center tw-w-[55px]">
                                <i class="fa-regular fa-sparkles tw-text-pink-400 fs-4 px-2"></i>
                            </div>
                        </li>
                        <li class="d-flex justify-between">
                            <div class="info">
                                <div class="fs-13px text-muted">Fundraising</div>
                                <div class="fs-20px text-dark" id="hub_fundraising">0</div>
                            </div>
                            <div class="tw-bg-orange-100 round-lg center tw-w-[55px]">
                                <i class="fa-regular fa-coin tw-text-orange-400 fs-4 px-2"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card card-bordered card-full">
                <div class="card-inner-group">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Latest Registered Users</h6>
                            </div>
                            <div class="card-tools">
                                <a href="{{route('admin.users.index')}}" class="link">View All</a>
                            </div>
                        </div>
                    </div>
                    <div id="latest_users">
                    </div>

                </div>
            </div><!-- .card -->
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $.ajax({
            url: '{{route('admin.overview.data')}}',
            type: 'GET',
            success: function (data) {
                console.log(data)
                $('#total_project').html(data.count.projects)
                $('#total_user').html(data.count.users)
                $('#total_experts').html(data.count.experts)
                $('#total_clients').html(data.count.client)
                $('#hub_partner').html(data.hub.partner)
                $('#hub_mna').html(data.hub.mna)
                $('#hub_marketing').html(data.hub.marketing)
                $('#hub_fundraising').html(data.hub.fund)
                // if (data.proje)
                let project_html = $('#latest_projects').html()
                if (data.projects.length > 0){
                    project_html = ''
                    data.projects.forEach(project => {
                        project_html += `<div class="card-inner card-inner-md">
                                <div class="user-card d-flex justify-between">
                                    <a href="{{route('admin.projects.show','')}}/${project.pid}" class="user-info">
                                            <span class="tw-text-slate-600">
                                                <i class="fa-solid fa-circle-small text-danger me-1"></i>
                                                <span>${project.name}</span>
                                            </span>
                                    </a>
                                    <div class="user-action ms-1">
                                        <div class="badge rounded-pill bg-${project.status == 'active' ? 'info' : (project.status == 'awarded' ? 'success' : 'secondary')} badge-sm text-capitalize">
                                            ${project.status == 'active' ? 'Shortlist' : project.status}
                                        </div>
                                    </div>
                                </div>
                            </div>`
                    })
                }
                $('#latest_projects').html(project_html)
                let users_html = ''
                data.users.forEach(user => {
                    users_html += `<div class="card-inner card-inner-md">
                            <div class="user-card">
                                <div class="user-avatar bg-primary-dim">
                                    <span>AB</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">${user.name}</span>
                                    <span class="sub-text">${user.email}</span>
                                </div>
                            </div>
                        </div>`
                })
                $('#latest_users').html(users_html)
            }
        });

    </script>
@endpush
