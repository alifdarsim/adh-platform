@extends('layouts.user.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Expert Profile</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage your expert profile information. This
                        information will be seen by the potential client that will take interest on hire
                        you for a project.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <btn onclick="edit()" class="btn btn-primary"><em class="icon ni ni-pen"></em><span>Update Expert Profile</span></btn>
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
                                        <img src="{{auth()->user()->avatar()}}" alt="profile" class="tw-w-32 tw-h-32 object-fit-cover tw-rounded-full"/>
                                    </div>
                                </div>
                                <div class="user-info tw-grid tw-gap-y-3">
                                    <h4 class="tw-text-slate-200">{{auth()->user()->name}}</h4>
                                    <div class="pt-0 mb-2">
                                        <h6 class="title tw-text-slate-200 fs-14px fw-medium px-3">Expert Profile Completion</h6>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="progress progress-lg !tw-bg-slate-300">
                                                    <div class="progress-bar bg-info" data-progress="{{round($expert_completion_count/7*100)}}">{{$expert_completion_count}}/7 ({{round($expert_completion_count/7*100)}}%)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <div class="user-expert-skills-title tw-text-slate-100 mb-1 fs-15px">Industry Classification</div>
                                <div class="user-expert-skills-content">
                                    @if(auth()->user()->expert->industry)
                                        <div>
                                            <p class="mb-0 text-white fs-14px mt-2"><span class="tw-text-slate-400">Main:</span> {{auth()->user()->expert->industry->main}}</p>
                                            <p class="mb-0 text-white fs-14px mt-1"><span class="tw-text-slate-400">Sub:</span> {{auth()->user()->expert->industry->sub}}</p>
                                        </div>
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
                                    @if((auth()->user()->expert->skills) == null)
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
                    <div class="p-4 pt-4">
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
                                            <div class="label fs-15px">{{$experience['position']}}</div>
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
        <div class="modal-dialog modal-dialog-centered modal-xl" style="--bs-modal-width: 1200px;" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-sm">
                    <div class="row">
                        <div class="col-3">
                            <div class="card-inner-group" style="border-right: 1px #333b45">
                                <div class="card-inner">
                                    <h5>Let’s Finish Profile</h5>
                                    <p>In order to rank higher in selection process, you might want to complete your expert profile for the client to review.</p>
                                </div>
                                <div class="card-inner">
                                    <ul class="list list-step">
                                        @foreach($expert_completion as $detail)
                                            <p class="mb-1">
                                                {!! $detail->status ? '<i class="fa-solid text-success fa-circle-check"></i>' : '<i class="fa-solid text-danger fa-circle-xmark"></i>' !!}
                                                 {{$detail->text}}
                                            </p>
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
                        <div class="col-9">
                            <ul class="nk-nav nav nav-tabs">
                                @foreach($expert_completion as $completion)
                                    <li class="nav-item">
                                        <a class="nav-link {{$loop->index == 0 ? 'active' : ''}}" data-bs-toggle="tab" href="#tab_{{$completion->tab}}">
                                            {!! $completion->status ? '<i class="fa-solid text-success fa-circle-check"></i>' : '<i class="fa-solid text-danger fa-circle-xmark"></i>' !!}
                                            <span class="ms-1">{{$completion->short}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_linkedin">
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <div class="nk-block-content-head">
                                                <h4>LinkedIn Url</h4>
                                            </div>
                                            <p>Your LinkedIn profile will be shown to next to your AsiaDealHub Expert profile.</p>
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control linkedin_url_input" name="linkedin_url_input"
                                                           value="{!! auth()->user()->expert->url ?? ''!!}"
                                                           placeholder="https://www.linkedin.com/in/your-profile-url">
                                                </div>
                                            </div>
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <button onclick="submitLinkedinUrl()" class="btn btn-primary">Update LinkedIn URL</button>
                                                    <button onclick="linkedin_sync()" class="ms-2 btn btn-outline-info">Sync LinkedIn Data</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_personal">
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
                                                    <textarea type="text" class="form-control" style="height: 214px;" id="edit-about" placeholder="Write something about yourself">{{auth()->user()->expert->about ?? 'Not Set Yet'}}</textarea>
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
                                <div class="tab-pane" id="tab_experience">
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
                                            <btn onclick="manual_experience()"
                                                 class="btn btn-lg !tw-bg-slate-200 text-secondary btn-light tw-w-full justify-center">
                                                <i class="fa-solid fa-plus me-1 fs-5"></i>Add Experience
                                            </btn>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_cv">
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
                                <div class="tab-pane" id="tab_industry">
                                    <div class="row gy-4">
                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="main-industry">Main Industry Classification</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2 select2-hidden-accessible" id="main-industry">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="sub-industry">Sub Industry Classification</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2 select2-hidden-accessible" id="sub-industry">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                    <li>
                                                        <button onclick="updateIndustry()" class="btn btn-primary">Update Industry Classification</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_skills">
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
                                <div class="tab-pane" id="tab_assessment">
                                    <div class="row gy-4">
                                        <div class="nk-block-content">
                                            <div class="nk-block-content-head">
                                                <h4>Assessment Test</h4>
                                            </div>
                                            <p>You need to complete an assessment test to prove your qualification & credibility here. This is a very simple question related taking a professional jobs.</p>
                                            <a class="btn btn-primary" href="{{route('assessment.question')}}">Go To Assessment Page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <div class="modal fade" tabindex="-1" role="dialog" id="intro_expert">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-md">
                    <h4 class="title center">Expert Profile Page</h4>
                    <div class="px-5">
                        <p class="mt-3 mb-0 tw-text-center">Here is the page where you view and setup your expert profile. Let's begin setting up your profile. This will help us identify your expertise and match you with the right projects.</p>
                        <div class="center mt-4">
                            <button onclick="nextstep()" class="btn btn-primary tw-px-20">Next</button>
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
                    _Swal.success(response.message, 'Success', function () {
                        location.reload();
                    });
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
            $('#modalForm').modal('show');
            $($('.modal-backdrop')[1]).css('z-index', 1052);
            $('#modalForm').css('z-index', 1053);
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
                url: '{{route('expert.profile.job_add')}}',
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
                url: '{{route('expert.profile.cv')}}',
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
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
                url: '{{route('expert.profile.skills')}}',
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

        function linkedin_sync(reload = false) {
            Swal.fire({
                title: 'Sync Profile with LinkedIn?',
                html: '<br><br><img alt="linkedin" src="/images/svg/linkedin.svg" style="width: 160px"></img><br><br>Do you want to update your expert profile with LinkedIn data?. If you prefer manual update, click "No"',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    _Swal.loading('Syncing LinkedIn', 'Initiating linkedin sync...');
                    $.ajax({
                        url: '{{route('expert.profile.linkedin_sync')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (response) {
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
                                                    Swal.update({ text: 'Getting Address information..' });
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

                            // _Swal.success('LinkedIn Synced', response.message, function () {
                            //     window.location.reload();
                            // })
                        },
                        error: function (response) {
                            _Swal.error(response.responseJSON.message)
                        }
                    });
                }else{
                    if (reload) window.location.reload();
                }
            })
        }

        function submitLinkedinUrl(){
            $.ajax({
                url: '{{route('expert.profile.linkedin')}}',
                data: {
                    linkedin_url: $('.linkedin_url_input').filter(function() { return $(this).val().trim() !== ''; }).eq(0).val(),
                    _token: '{{csrf_token()}}'
                },
                type: 'POST',
                success: function (response) {
                    _Swal.success('LinkedIn URL Added', response.message, function () {
                        linkedin_sync(true);
                    })
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            });
        }

        function nextstep(){
            $('#intro_expert').modal('hide');
            $('#editLead').modal('show');
        }

        $( document ).ready(function() {
            {{--            @if(auth()->user()->expert->url)--}}
            {{--            let modal = $('#intro_expert');--}}
            {{--            modal.modal({backdrop: 'static', keyboard: false})--}}
            {{--            modal.modal('show');--}}
            {{--            @endif--}}

            $.ajax({
                url: '{{route('industries_expert.main')}}',
                method: 'GET',
                success: function (response) {
                    response.forEach(function (industry) {
                        $('#main-industry').append('<option value="'+industry+'">'+industry+'</option>');
                    });
                    $('#main-industry').val('{{auth()->user()->expert->industry->main ?? ''}}').trigger('change');
                }
            });
        });

        let sub_industry = '{{auth()->user()->expert->industry->id ?? ''}}';
        $('#main-industry').on('change', function () {
            let main = $(this).val();
            if (main === null) return;
            main = main.replaceAll('/', '_');
            $.ajax({
                url: '{{route('industries_expert.sub','')}}/'+main,
                method: 'GET',
                success: function (response) {
                    $('#sub-industry').empty();
                    response.forEach(function (industry) {
                        $('#sub-industry').append('<option value="'+industry.id+'">'+industry.sub+'</option>');
                    });
                    if (sub_industry !== ''){
                        $('#sub-industry').val(sub_industry).trigger('change');
                        sub_industry = '';
                    }
                }
            });
        });

        function updateIndustry(){
            let id = $('#sub-industry').val();
            $.ajax({
                url: '{{route('expert.profile.industry')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    industry_id: id
                },
                success: function (response) {
                    _Swal.success('Industry Updated', response.message, function () {
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

