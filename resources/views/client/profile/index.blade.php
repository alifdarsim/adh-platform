@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Team</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome, {{auth()->user()->name}}! This is overview of your current projects.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="tw-grid tw-grid-cols-4 tw-gap-x-4">
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Ongoing Projects</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left" aria-label="Total active subscription"
                            data-bs-original-title="Total active subscription">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data"><span class="tw-text-4xl text-dark">1</span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Total Project Created</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left" aria-label="Total active subscription"
                            data-bs-original-title="Total active subscription">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data"><span class="tw-text-4xl text-dark">1</span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Completed Project</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left" aria-label="Total active subscription"
                            data-bs-original-title="Total active subscription">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data"><span class="tw-text-4xl text-dark">0</span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Earning</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left" aria-label="Total active subscription"
                            data-bs-original-title="Total active subscription">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data"><span class="tw-text-4xl text-dark">$0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <h5 class="nk-block-title">Client Information</h5>
        </div>
        <div class="row g-gs">
        </div>
    </div>

@endsection

@push('scripts')
    <script>

    </script>
@endpush
