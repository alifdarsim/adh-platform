@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Assessment Test</h3>
                <div class="nk-block-des text-soft"><p>Prove your qualification & credibility here</p></div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group tw-flex tw-justify-center">
                            <div class="card-title"><h5 class="title">You have completed the assessment test 🎉</h5></div>
                        </div>
                    </div>
                    <div class="px-5 py-4" id="question_holder">
                        <div id="introduction">
                            <div class="card !tw-bg-slate-100 mb-4 tw-w-96">
                            </div>

                            @if ($assessment->status == 'complete')
                                <div class="nk-block-content-head"><h6>You have complete the test successfully! You can start take available projects from AsiaDealHub</h6></div>
                                <p class="text-soft">You can retake the assessment anytime you want by reset the assessment status. Nonetheless, if you already
                                    complete the assessment, there is no need to retake the assessment as it does not affect anything's aspect for expert profile.</p>
                                <div class="text-center pt-3">
                                    <a href="{{route('expert.profile-completion')}}" class="btn btn-primary tw-w-80 clickable tw-justify-center">Back to Profile Completion</a>
                                </div>
                                <div class="text-center pt-3">
                                    <a onclick="retake()" class="btn btn-light tw-w-80 clickable tw-justify-center">Reset
                                        The Assessment</a>
                                </div>
                            @else
                                <div class="nk-block-content-head"><h6>Now you failed the assessment test. You can
                                        retake the test if you want.</h6></div>
                                <p class="text-soft">You can retake the test if you want. Nonetheless, if you already
                                    pass the assessment test, there is no need to retake the assessment test as profile
                                    score does not affect anything's aspect for expert profile.</p>
                                <div class="text-center pt-3">
                                    <a onclick="retake()" class="btn btn-primary tw-px-20 clickable">Reset The
                                        Assessment</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function retake() {
            Swal.fire({
                title: 'Reset Assessment Test?',
                text: "This will remove your assessment status result and you cannot take project until you complete the assessment again.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('assessment.retake')}}',
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            Swal.fire(
                                'Reset!',
                                'Your assessment test result has been removed. You will be redirected to the assessment test page.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '{{route('expert.assessment')}}';
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
