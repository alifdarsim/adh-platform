@extends('layouts.user.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Expert Profile Completion</h3>
                <div class="nk-block-des text-soft">
                    <p>You are few steps away to complete your profile. These are required in order to get full access to your account.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-custom-s1 card-bordered">
            <div class="row no-gutters">
                <div class="col-lg-4">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <h5>Let’s Finish Registration</h5>
                            <p>Only few minutes required to complete your registration and set up your
                                account.</p>
                        </div>

                        <div class="card-inner">
                            <ul class="list list-step">
                                @foreach($expert_completion as $detail)
                                    <li class="{{$detail->status ? 'list-step-done tw-line-through' : ''}}">{{$detail->text}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-inner">
                            <div class="align-center gx-3">
                                <div class="flex-item">
                                    <div class="progress progress-sm progress-pill w-80px">
                                        <div class="progress-bar !tw-bg-red-500"
                                             data-progress="{{$expert_completion_count/6*100}}"></div>
                                    </div>
                                </div>
                                <div class="flex-item">
                                    <span class="sub-text sub-text text-soft">{{$expert_completion_count}} / 6 Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card-inner card-inner-lg h-100 w-100">
                        <div class="w-100 h-100 pe-4 tw-flex tw-items-center">
                            <div id="linked_url_container" class="tw-hidden">
                                <div class="nk-block-content">
                                    <div class="nk-block-content-head">
                                        <h4>LinkedIn Profile URL</h4>
                                    </div>
                                    <p>Your LinkedIn profile will be shown to next to your
                                        AsiaDealHub Expert profile. This will help you to get more
                                        clients.</p>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                                   id="linkedin_url" name="linkedin_url"
                                                   value="{!! auth()->user()->expert->url ?? ''!!}"
                                                   placeholder="https://www.linkedin.com/in/your-profile-url">
                                        </div>
                                    </div>
                                    <btn onclick="submitLinkedinProfile()"
                                         class="btn btn-lg btn-primary">Submit URL
                                    </btn>
                                </div>
                            </div>

                            <div id="personal_detail_container" class="tw-hidden">
                                <div class="nk-block-content">
                                    <div class="nk-block-content-head">
                                        <h4>Fill In Your Details</h4>
                                    </div>
                                    <p>Fill in your personal details so that potential client can find you better and connect with you easier.</p>
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-email">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="edit-email" placeholder="Email" value="{{auth()->user()->email}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-name">Full Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="edit-name" placeholder="Name" value="{{auth()->user()->name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-phone">Phone</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="edit-phone" placeholder="Phone" value="{{auth()->user()->phone}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-about">Biography</label>
                                                <div class="form-control-wrap">
                                                    <textarea type="text" class="form-control" id="edit-about" placeholder="Write something about yourself">{{auth()->user()->expert->about ?? ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <button onclick="updatePersonalDetail()" class="btn btn-primary">Update Personal Detail</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="job_experience_container" class="w-100 tw-hidden">
                                <div class="nk-block-content">
                                    <div
                                        class="nk-block-content-head tw-flex tw-justify-between tw-items-center">
                                        <h4 class="mb-0">Job Experience</h4>
                                    </div>
                                    @if(!$expert_completion->experience->status)
                                        <div class="nk-news card card-bordered">
                                            <div class="card-inner">
                                                <div class="nk-news-list tw-items-center">
                                                    <div class="">You do not have any job experience
                                                        yet. Please add your job experience.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-4 tw-flex w-100 tw-justify-center tw-items-center">
                                            <btn onclick="linkedin_sync()"
                                                 class="btn btn-lg !tw-bg-blue-500 text-white tw-w-full justify-center">
                                                <i class="fa-brands fa-linkedin me-1 fs-5"></i>Sync with
                                                LinkedIn
                                            </btn>
                                            <div class="mx-3">OR</div>
                                            <btn onclick="manual_experience()"
                                                 class="btn btn-lg !tw-bg-slate-200 text-secondary btn-light tw-w-full justify-center">
                                                <i class="fa-solid fa-plus me-1 fs-5"></i>Add Experience
                                                Manually
                                            </btn>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="cv_container" class="tw-hidden">
                                <div class="nk-block-content">
                                    <div class="nk-block-content-head">
                                        <h4>Upload Your CV/Resume</h4>
                                    </div>
                                    <p>By uploading your resume, you can give a good impression toward
                                        potential client. This will help you to get more projects.</p>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="file" class="form-control"
                                                   id="cv" name="cv"
                                                   value=""
                                                   placeholder="Your Resume">
                                        </div>
                                    </div>
                                    <btn onclick="submitCv()"
                                         class="btn btn-lg btn-primary">Submit CV/Resume
                                    </btn>
                                </div>
                            </div>
                            <div id="skills_container" class="tw-hidden">
                                <div class="nk-block-content">
                                    <div class="nk-block-content-head">
                                        <h4>Skills List</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="skills">Write any of your relevant skills here. Just type skills and press enter to insert to your skills list.</label>
                                        <div class="form-control-wrap ">
                                            <input type="text" id="skills" class="form-control tagify tw-w-full mt-2" placeholder="Add Skills">
                                        </div>
                                    </div>
                                    <div class="btn btn-primary" onclick="submitSkills()">Submit All Skills</div>
                                </div>
                            </div>
                            <div id="assessment_container" class="tw-hidden">
                                <div class="nk-block-content">
                                    <div class="nk-block-content-head">
                                        <h4>Assessment Test</h4>
                                    </div>
                                    <p>We need to complete an assessment test to prove your qualification & credibility here. This is a very simple question related taking a professional jobs.</p>
                                    <a class="btn btn-secondary" href="{{route('assessment.question')}}">Go To Assessment Page</a>
                                </div>
                            </div>
                            <div id="complete_container" class="w-100 tw-hidden">
                                <div class="nk-block-content text-center">
                                    <div class="nk-block-content-head">
                                        <h4>Congrats! You have complete your Expert Profile</h4>
                                    </div>
                                    <div>
                                        <img src="/images/svg/profile-complete.svg" alt="complete" class="tw-w-64">
                                    </div>
                                    <btn onclick="window.location.href = '{{route('expert.profile.data')}}'"
                                         class="btn btn-danger mt-2">View My Expert Profile
                                    </btn>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script>
        let expert_completion_current = @json($expert_completion);

        $(document).ready(function () {
            console.log(expert_completion_current);
            if (!expert_completion_current.linkedin.status) {
                $('#linked_url_container').removeClass('tw-hidden');
            } else if (!expert_completion_current.personal.status) {
                $('#personal_detail_container').removeClass('tw-hidden');
            } else if (!expert_completion_current.experience.status) {
                $('#job_experience_container').removeClass('tw-hidden');
            } else if (!expert_completion_current.cv.status) {
                $('#cv_container').removeClass('tw-hidden');
            } else if (!expert_completion_current.skills.status) {
                $('#skills_container').removeClass('tw-hidden');
            } else if (!expert_completion_current.assessment.status){
                $('#assessment_container').removeClass('tw-hidden');
            } else {
                $('#complete_container').removeClass('tw-hidden');
            }
        });

        function submitLinkedinProfile() {
            $.ajax({
                url: '{{route('expert.profile-completion.linkedin')}}',
                data: {
                    linkedin_url: $('#linkedin_url').val(),
                    _token: '{{csrf_token()}}'
                },
                type: 'POST',
                success: function (response) {
                    console.log(response);
                    if (response.expert_exist){
                        Swal.fire({
                            title: 'LinkedIn Sync..',
                            text: 'Getting Personal data..',
                            showCancelButton: false,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            onOpen: function () {
                                Swal.showLoading();
                                setTimeout(() => {
                                    Swal.update({ text: 'Getting About section..' });
                                    setTimeout(() => {
                                        Swal.update({ text: 'Getting Skills experiences..' });
                                        setTimeout(() => {
                                            Swal.update({ text: 'Getting Job Experiences list..' });
                                            setTimeout(() => {
                                                Swal.update({ text: 'Getting Educations list..' });
                                                setTimeout(() => {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success!',
                                                        text: 'LinkedIn data sync successfully.',
                                                        showCancelButton: false,
                                                        confirmButtonText: 'Ok'
                                                    }).then((result) => {
                                                        window.location.reload();
                                                    })
                                                }, 1000);
                                            }, 1000);
                                        }, 1000);
                                    }, 1000);
                                }, 2000);
                            }
                        });
                    }
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            });
        }

        function jobExperienceInsert() {

        }

        function linkedin_sync() {
            // add loading Swal here
            Swal.fire({
                title: 'Syncing with LinkedIn',
                text: 'Please wait...',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                onOpen: function () {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: '{{route('expert.profile-completion.linkedin')}}',
                type: 'GET',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    _Swal.success('LinkedIn Synced', response.message, function () {
                        window.location.reload();
                    })
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            });
        }

        function submitCv() {
            let formData = new FormData();
            let cv = $('#cv')[0].files[0];
            formData.append('upload_cv', cv);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '{{route('expert.profile-completion.cv')}}',
                data: formData,
                type: 'POST',
                processData: false, // prevent jQuery from converting the data into a query string
                contentType: false, // prevent jQuery from setting the Content-Type header
                success: function (response) {
                    _Swal.success('CV Added', response.message, function () {
                        window.location.reload();
                    })
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            });
        }

        function updatePersonalDetail(){
            let name = $('#edit-name').val();
            let phone = $('#edit-phone').val();
            let linkedin = $('#edit-linkedin').val();
            let bio = $('#edit-biography').val();
            $.ajax({
                url: '{{route('expert.profile.update')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    name: name,
                    phone: phone,
                    linkedin: linkedin,
                    bio: bio
                },
                success: function (response) {
                    _Swal.success('Personal Detail Updated', response.message, function () {
                        window.location.reload();
                    })
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            })
        }

        function submitSkills(){
            let skills = $('#skills').val();
            $.ajax({
                url: '{{route('expert.profile-completion.skills')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    skills: skills
                },
                success: function (response) {
                    _Swal.success('Skills Added', response.message, function () {
                        window.location.reload();
                    })
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            })
        }

        $('.tagify').tagify({
            whitelist: [],
            dropdown: {
                enabled: 1
            }
        });

        function manual_experience(){

        }


    </script>
@endpush

