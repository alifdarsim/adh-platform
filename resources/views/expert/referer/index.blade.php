@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Referral Link</h3>
                <div class="nk-block-des text-soft">
                    <p>Use this link to refer users to Expert Dashboard.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <button class="btn btn-primary" onclick="copyToClipboard('{{route('register.index', 'expert')}}?ref={{$referer_code}}')">Copy Referral Link</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function copyToClipboard(text) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            Swal.fire({
                icon: 'success',
                title: 'Referral Link Copied',
                showConfirmButton: false,
                timer: 750
            });
        }
    </script>
@endpush
