<div class="modal fade" tabindex="-1" id="modalExpertDetail">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="card-aside-wrap tw-grid tw-grid-cols-7">
                <div class="tw-col-span-2 tw-bg-slate-800">
                    <div class="card-inner-group" data-simplebar>
                        <div class="card-inner tw-py-3">
                            <div class="user-card user-card-s2">
                                <div class="tw-relative">
                                    <div class="tw-w-28 tw-h-28 user-avatar bg-dim-primary d-none d-sm-flex" id="detail_image"></div>
                                </div>
                                <div class="!tw-mt-0 user-info tw-grid tw-gap-y-1">
                                    <h4 id="detail_name" class="tw-text-slate-200"></h4>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-regular fa-envelope tw-text-blue-500 fs-6 me-1"></i><span id="detail_email"></span>
                                    </div>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-regular fa-phone fs-6 tw-text-blue-500 me-1"></i><span id="detail_phone"></span>
                                    </div>
                                    <div class="sub-text tw-text-slate-300"><i
                                            class="fa-regular fa-location-dot fs-6 tw-text-blue-500 me-1"></i><span id="detail_address"></span>
                                    </div>
                                    <a href="" target="_blank" class="sub-text tw-text-slate-300">
                                        <i class="fa-brands fa-linkedin tw-text-blue-500 fs-6 me-1"></i>
                                        <span id="detail_linkedin_url"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner tw-px-7 tw-py-3">
                            <div class="user-expert-skills py-0">
                                <div class="user-expert-skills-title tw-text-slate-100 mb-1 fs-14px">Industry Classification</div>
                                <div class="user-expert-skills-content" id="detail_industry">
                                </div>
                            </div>
                        </div>
                        <div class="card-inner tw-px-4 tw-py-4">
                            <div class="user-expert-skills py-0">
                                <div class="user-expert-skills-title tw-text-slate-100 mb-1 fs-14px">Skills</div>
                                <div class="user-expert-skills-content" id="detail_skills">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-col-span-5 card-inner">
                    <div class="p-4 pt-0">
                        <h6 class="title">About</h6>
                        <div class="">
                            <p class="fs-13px" id="detail_about"></p>
                        </div>
                    </div>
                    <hr class="tw-h-px tw-my-0 tw-bg-gray-200 tw-border-0 dark:tw-bg-gray-700">
                    <div class="">
                        <div class="card-inner border-bottom py-2">
                            <div class="card-title-group g-2">
                                <div class="card-title"><h6 class="title">Job Experiences</h6></div>
                            </div>
                        </div>
                        <ul class="nk-activity" id="detail_job_experiences">
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
</div>

@push('scripts')
    <script>
        function expert_detail(id){
            $('#modalExpertDetail').modal('show');
            $($('.modal-backdrop')[1]).css('z-index', '1052');
            $('#modalExpertDetail').css('z-index', '1053');
            console.log(id)
            console.log(experts_info)
            let data = experts_info.find(item => item.expert.id === id).expert;
            console.log(data)
            $('#detail_image').html('');
            $('#detail_image').append(data.img_url ? `<img src="${data.img_url}" alt="profile" class="tw-w-28 tw-h-28 object-fit-cover tw-rounded-full"/>` : `<span class="text-white fs-1">N/A</span>`);
            // $('#detail_image').attr('src', (data.img_url ?? '').replaceAll('&amp;', "&"));
            $('#detail_name').html(data.name);
            $('#detail_email').html(data.email ?? 'Not Set');
            $('#detail_phone').html(data.phone ?? 'Not Set');
            $('#detail_address').html(data.address ?? 'Not Set');
            $('#detail_linkedin_url').html((data.url ?? 'Not Set').replaceAll('https://www.linkedin.com/in/', ''));
            $('#detail_linkedin_url').parent().attr('href', data.url ?? '#' );
            $('#detail_about').html(data.about ?? '-');
            if (data.experiences.length > 0){
                $('#detail_job_experiences').html('');
                data.experiences.forEach((experience, index) => {
                    $('#detail_job_experiences').append(`
                        <li class="nk-activity-item tw-flex tw-justify-between py-1 position_${index}">
                            <div class="nk-activity-data ms-0">
                                <div class="label fs-15px">${experience['position']}</div>
                                <span class="time">${experience['company']}</span>
                                <span class="time">${experience['location']}</span>
                            </div>
                            <div class="nk-activity-data ms-0">
                                <span class="label fs-14px">${experience['duration']}</span>
                            </div>
                        </li>
                    `);
                });
            }else{
                $('#detail_job_experiences').html('No Job Experiences Added Yet');
            }
            $('#detail_industry').html('');
            if (data.industry){
                $('#detail_industry').append(`
                    <div>
                        <p class="mb-0 text-white fs-13px mt-1"><span class="tw-text-slate-300">Main:</span> ${data.industry.main}</p>
                        <p class="mb-0 text-white fs-13px mt-0"><span class="tw-text-slate-300">Sub:</span> ${data.industry.sub}</p>
                    </div>
                `);
            }else{
                $('#detail_industry').append(`
                    <i class="fa-solid fa-circle-small fs-12px"></i>
                    <span class="badge bg-dark fs-12px tw-capitalize">Not set Yet</span>
                `);
            }
            $('#detail_skills').html('');
            if (data.skills){
                data.skills.forEach(skill => {
                    $('#detail_skills').append(`
                        <span class="badge bg-outline-gray tw-text-slate-300 tw-capitalize">${skill}</span>
                    `);
                });
            }else{
                $('#detail_skills').append(`
                    <span class="badge bg-outline-gray text-white tw-capitalize">Not set Yet</span>
                `);
            }
        }
    </script>
@endpush
