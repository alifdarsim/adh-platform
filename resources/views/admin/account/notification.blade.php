@extends('layouts.admin.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Notification Settings</h3>
                <div class="nk-block-des text-soft"><p>You will get only notification what have enabled.</p></div>
            </div>
        </div>
    </div>
    @include('admin.account.tabs')
    <div class="nk-block">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-head-content">
                <h5>Security Alerts</h5>
                <div class="nk-block-des">
                    <p>You will get only those email notification what you want.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block-content">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="gy-3">
                        <div class="g-item">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" checked
                                       id="unusual-activity">
                                <label class="custom-control-label" for="unusual-activity">Send also email for each notification that I receive</label>
                            </div>
                        </div>
                    </div>
                </div><!-- .card-inner-group -->
            </div><!-- .card -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush

