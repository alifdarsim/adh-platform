@extends('layouts.user.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Expert Profile</h3>
                <div class="nk-block-des text-soft"><p>Manage your expert profile information. This
                        information will be seen by the potential client that will take interest on hire
                        you for a project.</p></div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                       data-target="pageMenu"><em class="icon ni ni-more-v"></em>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered mt-0">
            <div class="card-aside-wrap tw-grid tw-grid-cols-7">
                <div class="tw-col-span-2 tw-bg-slate-800">
                    <div class="card-inner-group" data-simplebar>
                        <div class="card-inner tw-p-8">
                            <div class="user-card user-card-s2">
                                <div class="tw-relative">
                                    <div class="tw-w-32 tw-h-32">
                                        <img alt="profile"
                                             class="tw-w-32 tw-h-32 object-fit-cover tw-rounded-full"
                                             src="{{auth()->user()->avatar()}}"/>
                                    </div>
                                </div>
                                <div class="user-info tw-grid tw-gap-y-3">
                                    <h4 class="tw-text-slate-200">{{auth()->user()->name}}</h4>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-regular fa-envelope tw-text-blue-500 fs-6 me-1"></i> {{auth()->user()->email}}
                                    </div>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-regular fa-phone fs-6 tw-text-blue-500 me-1"></i> {{auth()->user()->phone ?? 'Not set yet'}}
                                    </div>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-regular fa-location-dot fs-6 tw-text-blue-500 me-1"></i> {{auth()->user()->expert->address ?? 'Not set yet'}}
                                    </div>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-brands fa-linkedin tw-text-blue-500 fs-6 me-1"></i>
                                        {{str_replace("https://www.", "", auth()->user()->expert->url ?? 'Not set yet')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner tw-px-7 tw-py-8">
                            <div class="user-expert-skills py-0">
                                <div class="user-expert-skills-title tw-text-slate-100 mb-1 fs-15px">Educations</div>
                                <div class="user-expert-skills-content">
                                    @if(!(auth()->user()->expert == null) && auth()->user()->expert->educations)
                                        @foreach(auth()->user()->expert->educations as $education)
                                            <div>
                                                <p class="mb-0 text-white fs-12px mt-2">· {{$education['degree']}}</p>
                                                <p class="mb-0 text-white fs-12px">· {{$education['school']}}</p>
                                                <p class="mb-0 text-white fs-12px">· {{$education['duration']}}</p>
                                            </div>
                                        @endforeach
                                    @else
                                        <div>
                                            <i class="fa-solid fa-circle-small fs-12px"></i>
                                            <span class="badge bg-dark fs-12px tw-capitalize">Not set Yet</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-inner tw-px-7 tw-py-8">
                            <div class="user-expert-skills py-0">
                                <div class="user-expert-skills-title tw-text-slate-100 mb-1 fs-15px">Skills</div>
                                <div class="user-expert-skills-content">
                                    @if((auth()->user()->expert == null ? false : auth()->user()->expert->skills) == null)
                                        <span class="badge bg-outline-gray text-white tw-capitalize">Not set Yet</span>
                                    @else
                                        @foreach(auth()->user()->expert->skills as $skill)
                                            <span
                                                class="badge bg-outline-gray text-white tw-capitalize">{{$skill}}
                                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-col-span-5 card-inner">
                    <div class="justify-end">
                        <btn onclick="edit()" class="btn btn-primary"><em class="icon ni ni-pen"></em><span>Edit</span></btn>
                    </div>
                    <div class="p-4 pt-0">
                        <h6 class="title">About</h6>
                        <div class="">
                            <p>{{auth()->user()->expert->about ?? 'No About added yet'}}</p>
                        </div>
                    </div>
                    <hr class="tw-h-px tw-my-0 tw-bg-gray-200 tw-border-0 dark:tw-bg-gray-700">
                    <div class="p-4">
                        <h6 class="title">Resume/CV</h6>
                        <div class="">
                            @if( auth()->user()->expert == null ? false : auth()->user()->expert->getMedia('cv')->count() > 0 )
                                <a href="{{auth()->user()->expert->getMedia('cv')->last()->original_url}}" target="_blank" class="btn btn-white btn-outline-info me-1">
                                    <em class="icon ni ni-download-cloud"></em><span>Download</span>
                                </a>
                            @else
                                No Resume/CV added Yet
                            @endif
                        </div>
                    </div>
                    <hr class="tw-h-px tw-my-0 tw-bg-gray-200 tw-border-0 dark:tw-bg-gray-700">
                    <div class="">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group g-2">
                                <div class="card-title"><h6 class="title">Job Experiences</h6></div>
                            </div>
                        </div>
                        <ul class="nk-activity">
                            @if(auth()->user()->expert == null || !auth()->user()->expert->experiences)
                                <li class="nk-activity-item tw-flex tw-justify-between">
                                    <div class="nk-activity-data ms-0">
                                        <div class="label fs-17px">No Job Experiences Added Yet</div>
                                    </div>
                                </li>
                            @else
                                @foreach(auth()->user()->expert->experiences as $experience)
                                    <li class="nk-activity-item tw-flex tw-justify-between position_{{$loop->index}}">
                                        <div class="nk-activity-data ms-0">
                                            <div class="label fs-17px">{{$experience['position']}}</div>
                                            <span class="time">{{$experience['company']}}</span>
                                            <span class="time">{{$experience['location']}}</span>
                                        </div>
                                        <div class="nk-activity-data ms-0">
                                            <span class="label fs-14px">{{$experience['duration']}}</span>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="editLead" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title">Edit Expert Information</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetail">Personal Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#jobExperience">Job Experience</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#cvresume">CV/Resume</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#skills_data">Skills</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profileImage">Profile Picture</a>
                        </li>
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetail">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="edit-name">Name</label>
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
                                        <label class="form-label" for="edit-about">About</label>
                                        <div class="form-control-wrap">
                                            <textarea type="text" class="form-control" id="edit-about" placeholder="Write something about yourself">{{auth()->user()->expert->about ?? 'Not Set Yet'}}</textarea>
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
                        <div class="tab-pane" id="jobExperience">
                            <div class="nk-block-content">
                                <div id="experience_container" class="tw-h-80 tw-overflow-y-auto">
                                    @if(auth()->user()->expert == null || !auth()->user()->expert->experiences)
                                        <li class="nk-activity-item tw-flex tw-justify-between">
                                            <div class="nk-activity-data ms-0">
                                                <div class="label fs-17px">No Job Experiences Added Yet</div>
                                            </div>
                                        </li>
                                    @else
                                        @foreach(auth()->user()->expert->experiences as $experience)
                                            <li class="nk-activity-item tw-flex tw-justify-between position_{{$loop->index}}">
                                                <div class="nk-activity-data ms-0">
                                                    <div class="label fs-17px">{{$experience['position']}}</div>
                                                    <span class="time">{{$experience['company']}}</span>
                                                    <span class="time">{{$experience['location']}}</span>
                                                </div>
                                                <div class="nk-activity-data ms-0">
                                                    <span class="label fs-14px">{{$experience['duration']}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </div>
                                <div
                                    class="mt-4 tw-flex w-100 tw-justify-center tw-items-center">
{{--                                    <btn onclick="linkedin_sync()"--}}
{{--                                         class="btn btn-lg !tw-bg-blue-500 text-white tw-w-full justify-center">--}}
{{--                                        <i class="fa-brands fa-linkedin me-1 fs-5"></i>Sync with--}}
{{--                                        LinkedIn--}}
{{--                                    </btn>--}}
{{--                                    <div class="mx-3">OR</div>--}}
                                    <btn onclick="manual_experience()"
                                         class="btn btn-lg !tw-bg-slate-200 text-secondary btn-light tw-w-full justify-center">
                                        <i class="fa-solid fa-plus me-1 fs-5"></i>Add Experience
                                    </btn>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="cvresume">
                            <p>By uploading your resume, you can give a good impression toward
                                potential client. This will help you to get more projects.</p>
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    @if(auth()->user()->expert == null || auth()->user()->expert->getMedia('cv')->count() == 0)
                                        <label for="cv">No CV/Resume Uploaded Yet</label>
                                    @else
                                        <label for="cv">Uploaded CV: {{auth()->user()->expert->getMedia('cv')->last()->file_name ?? ''}}</label>
                                    @endif
                                    <input type="file" class="form-control"
                                           id="cv" name="cv"
                                           value=""
                                           placeholder="Your Resume"/>
                                </div>
                            </div>
                            <btn onclick="submitCv()"
                                 class="btn btn-lg btn-primary">Submit CV/Resume
                            </btn>
                        </div>
                        <div class="tab-pane" id="profileImage">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="example-alert"><div class="alert alert-secondary alert-icon"><em class="icon ni ni-user"></em> To change profile image, please go to <a href="{{route('expert.profile')}}" class="alert-link">Profile Setting</a>.</div></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="skills_data">
                            <div class="row gy-4">
                                <div class="nk-block-content">
                                    <div class="form-group">
                                        <label for="skills">Write any of your relevant skills here. Just type skills and press enter to insert to your skills list.</label>
                                        <div class="form-control-wrap ">
                                            @if(auth()->user()->expert == null || !auth()->user()->expert->skills)
                                                <span class="badge bg-outline-gray text-white tw-capitalize">Not set Yet</span>
                                            @else
                                                <input type="text" id="skills" class="form-control tagify tw-w-full mt-2" value="{{implode(", ", auth()->user()->expert->skills)}}" placeholder="Add Skills">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="btn btn-primary" onclick="submitSkills()">Submit All Skills</div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .tab-content -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->

    <div class="modal modal-lg fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Job Experience</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="position-title">Position</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="position-title" placeholder="Eg: Senior Design Engineer" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label" for="position-companyName">Company Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="position-companyName" placeholder="Eg: Azure Metal Pte Ltd" required>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label" for="position-address">Short Address (City, Country)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="position-address" placeholder="Eg: Jakarta, Indonesia" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-6">
                            <label class="form-label" for="position-year">Start Date</label>
                            <div class="row">
                                <div class="form-control-wrap col-6 pe-1">
                                    <label for="from-position-month" class="sub-text">Month</label>
                                    <select class="form-select js-select2 select2-month" data-placeholder="Month" id="from-position-month">
                                    </select>
                                </div>
                                <div class="form-control-wrap col-6 ps-1">
                                    <label for="from-position-year" class="sub-text">Year</label>
                                    <select class="form-select js-select2 select2-year" data-placeholder="Year" id="from-position-year">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="tw-flex tw-justify-between">
                                <label class="form-label" for="position-year">End Date</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label fs-12px" for="customCheck1">Currently working here</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-control-wrap col-6 pe-1">
                                    <label for="to-position-month" class="sub-text">Month</label>
                                    <select class="form-select js-select2 select2-month" data-placeholder="-" id="to-position-month">
                                    </select>
                                </div>
                                <div class="form-control-wrap col-6 ps-1">
                                    <label for="to-position-year" class="sub-text">Year</label>
                                    <select class="form-select js-select2 select2-year" data-placeholder="-" id="to-position-year">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button onclick="savePosition()" class="btn btn-lg btn-primary">Save Informations</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script>
        function edit(){
            $('#editLead').modal('show');
        }

        $(document).ready(function () {
            // $('#editLead').modal('show');
            $('.select2-month').select2({
                data: [
                    {id: 'Jan', text: 'Jan'},
                    {id: 'Feb', text: 'Feb'},
                    {id: 'Mar', text: 'Mar'},
                    {id: 'Apr', text: 'Apr'},
                    {id: 'May', text: 'May'},
                    {id: 'Jun', text: 'Jun'},
                    {id: 'Jul', text: 'Jul'},
                    {id: 'Aug', text: 'Aug'},
                    {id: 'Sep', text: 'Sep'},
                    {id: 'Oct', text: 'Oct'},
                    {id: 'Nov', text: 'Nov'},
                    {id: 'Dec', text: 'Dec'},
                ],
                minimumResultsForSearch: Infinity,
                dropdownParent: $('#modalForm')
            });
            let currentYear = new Date().getFullYear();
            let yearOptions = [];
            for (let year = currentYear; year >= currentYear - 100; year--) {
                yearOptions.push({ id: year.toString(), text: year.toString() });
            }
            $('.select2-year').select2({
                data: yearOptions,
                minimumResultsForSearch: Infinity,
                dropdownParent: $('#modalForm')
            });
        });

        function updatePersonalDetail(){
            let name = $('#edit-name').val();
            let phone = $('#edit-phone').val();
            let about = $('#edit-about').val();
            $.ajax({
                url: '{{route('expert.profile.update')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    name: name,
                    phone: phone,
                    about: about,
                },
                success: function (response) {
                    if (response.success){
                        $('#editLead').modal('hide');
                        _Swal.success(response.message, 'Success', function () {
                            location.reload();
                        });
                    }
                }
            })
        }

        function delete_experience(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this experience?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3b3f5c',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('expert.profile.job-remove')}}',
                        method: 'delete',
                        data: {
                            _token: '{{csrf_token()}}',
                            title: $('#position_'+id).find('.pos_title').text(),
                            company: $('#position_'+id).find('.pos_company').text(),
                        },
                        success: function (response) {
                            _Swal.success(response.message, 'Success', function () {
                                $('.position_'+id).remove();
                            });
                        }
                    })
                }
            })
        }

        function manual_experience(){
            $('#editLead').modal('hide');
            $('#modalForm').modal('show');
        }

        $('#customCheck1').on('change', function () {
            if ($(this).is(':checked')){
                $('#to-position-month').val(null).trigger('change');
                $('#to-position-year').val(null).trigger('change');
                $('#to-position-month').prop('disabled', true);
                $('#to-position-year').prop('disabled', true);
            }else{
                $('#to-position-month').prop('disabled', false);
                $('#to-position-year').prop('disabled', false);
            }
        });

        function savePosition(){
            let title = $('#position-title').val();
            let company = $('#position-companyName').val();
            let address = $('#position-address').val();
            let start_month = $('#from-position-month').val();
            let start_year = $('#from-position-year').val();
            let end_month = $('#to-position-month').val();
            let end_year = $('#to-position-year').val();
            $.ajax({
                url: '{{route('expert.profile.job-add')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    title: title,
                    company: company,
                    address: address,
                    start_month: start_month,
                    start_year: start_year,
                    end_month: end_month,
                    end_year: end_year,
                },
                success: function (response) {
                    if (response.success){
                        $('#modalForm').modal('hide');
                        _Swal.success(response.message, 'Success', function () {
                            location.reload();
                        });
                    }
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

        $('.tagify').tagify({
            whitelist: [],
            dropdown: {
                enabled: 1
            }
        });

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
    </script>
@endpush

