<div class="nk-block-head-content">
    <h5 class="title mb-1 mt-4 pb-1">Project Information</h5>
</div>
<div class="card card-bordered card-preview">
    <div class="card-inner">
        <ul class="nav nav-tabs mt-n3" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5" aria-selected="true" role="tab">
                    <i class="fa-regular fa-rectangle-history-circle-user fs-5 me-1"></i><span>Details</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#tabItem6" aria-selected="false" tabindex="-1" role="tab">
                    <i class="fa-regular fa-handshake fs-5 me-1"></i><span>Target Expert</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#tabItem7" aria-selected="false" tabindex="-1" role="tab">
                    <i class="fa-regular fa-briefcase fs-5 me-1"></i><span>Client Company</span>
                </a>
            </li>
{{--            <li class="nav-item" role="presentation">--}}
{{--                <a class="nav-link" data-bs-toggle="tab" href="#tabItem8" aria-selected="false" tabindex="-1" role="tab">--}}
{{--                    <i class="fa-regular fa-file fs-5 me-1"></i><span>Documents</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabItem5" role="tabpanel">
                <h5 class="title mb-3">Project Detail</h5>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="project-name">Project
                                Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="project-name" name="project-name" value="{{$project->name}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="project-description">Project
                                Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm"
                                          id="project-description"
                                          name="project-description"
                                          placeholder="Write Project Description"
                                          required disabled>{{$project->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label class="form-label" for="hub">Hub Type</label>
                            <div class="form-control-wrap">
                                <input type="text" id="hub" class="form-control" value="{{$project->hub()->first()->name}}" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label class="form-label" for="deadline">Deadline Date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left"><em
                                        class="icon ni ni-calendar"></em></div>
                                <input id="deadline" type="text"
                                       class="form-control" value="{{ formatDate($project->deadline)}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabItem6" role="tabpanel">
                <h5 class="title mb-3">Target Partners Information </h5>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="target_country">Target Country</label>
                            <div class="form-control-wrap">
                                <input id="target_country" type="text"
                                       class="form-control" value="{{$project->targetCountries->map(function($country) { return $country->emoji . ' ' . $country->name; })->implode(',  ')}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="target_company_size">Target Company Size</label>
                            <div class="form-control-wrap">
                                <input id="target_company_size" type="text" class="form-control" value="{{$project->projectTargetInfo->company_size}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="target_industry">Main Industry Classification</label>
                            <div class="form-control-wrap">
                                <input id="target_industry" type="text"
                                       class="form-control" value="{{$project->projectTargetInfo->industry->main ?? ''}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="target_industry">Sub Industry Classification</label>
                            <div class="form-control-wrap">
                                <input id="target_industry" type="text"
                                       class="form-control" value="{{$project->projectTargetInfo->industry->sub ?? ''}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="communication_language">Preferred Communication Language</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="communication_language" name="communication_language"
                                        multiple="multiple" data-placeholder="Select Language" data-search="on" disabled>
                                    <option value=""></option>
                                    <option value="English">English</option>
                                    <option value="Chinese">Chinese (漢語)</option>
                                    <option value="Japanese">Japanese (日本語)</option>
                                    <option value="Korean">Korean (한국어)</option>
                                    <option value="Thai">Thai (ภาษาไทย)</option>
                                    <option value="Vietnamese">Vietnamese (Tiếng Việt)</option>
                                    <option value="Indonesian">Indonesian (Bahasa Indonesia)</option>
                                    <option value="Malay">Malay (Bahasa Melayu)</option>
                                    <option value="Filipino">Filipino (Tagalog)</option>
                                    <option value="Burmese">Burmese (မြန်မာဘာသာ)</option>
                                    <option value="Khmer">Khmer (ភាសាខ្មែរ)</option>
                                    <option value="Lao">Lao (ລາວ)</option>
                                    <option value="Hindi">Hindi (हिन्दी)</option>
                                    <option value="Arabic">Arabic (العربية)</option>
                                    <option value="Spanish">Spanish (Español)</option>
                                    <option value="French">French (Français)</option>
                                    <option value="German">German (Deutsch)</option>
                                    <option value="Russian">Russian (русский)</option>
                                    <option value="Portuguese">Portuguese (Português)</option>
                                    <option value="Italian">Italian (Italiano)</option>
                                    <option value="Dutch">Dutch (Nederlands)</option>
                                    <option value="Polish">Polish (Polskie)</option>
                                    <option value="Turkish">Turkish (Türk)</option>
                                    <option value="Persian">Persian (فارسی)</option>
                                    <option value="Swedish">Swedish (Svenska)</option>
                                    <option value="Romanian">Romanian (Română)</option>
                                    <option value="Greek">Greek (Ελληνικά)</option>
                                    <option value="Hungarian">Hungarian (Magyar)</option>
                                    <option value="Czech">Czech (Čeština)</option>
                                    <option value="Finnish">Finnish (Suomalainen)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="form-group">
                            <label class="form-label" for="target_keyword">Target Product/Service/Industry Keyword<i class="fs-6 ms-1 text-info fa-solid fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="These keyword will be use to match the best potential partners for this project. (Max. 20 keyword)"></i></label>
                            <div class="form-control-wrap">
                                <input type="text" id="target_keyword" class="form-control tagify" placeholder="Add Keyword" readonly>
                            </div>
                            <span class="sub-text tw-mt-0.5">Eg: Food Processing, Packaging, Noodles, Mobile Apps</span>
                        </div>
                    </div>
                    <div class="col-12 mt-4 mb-2">
                        <div class="form-control-wrap">
                            <label class="form-label" for="target_industry">Key Questions to Potential Partner<i class="fs-6 ms-1 text-info fa-solid fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="A set of questions that will be asked to a potential partners before they will be match as potential partner"></i></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Q1</span></div>
                                <input type="text" id="q1" value="{{($project->questions)[0] ?? '' }}" class="form-control target_question" placeholder="No question" disabled>
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q2</span></div>
                                <input type="text" id="q2" value="{{($project->questions)[1] ?? ''}}" class="form-control target_question" placeholder="No question" disabled>
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q3</span></div>
                                <input type="text" id="q3" value="{{($project->questions)[2] ?? ''}}" class="form-control target_question" placeholder="No question" disabled>
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q4</span></div>
                                <input type="text" id="q4" value="{{($project->questions)[3] ?? ''}}" class="form-control target_question" placeholder="No question" disabled>
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q5</span></div>
                                <input type="text" id="q5" value="{{($project->questions)[4] ?? ''}}" class="form-control target_question" placeholder="No question" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabItem7" role="tabpanel">
                <h5 class="title">Client Company information</h5>
                <div id="company_section" class="mt-2">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="px-0" id="company_holder">
                                <h6 class="overline-title mb-2">Company Information</h6>
                                <div class="card bg-white tw-border tw-border-slate-300">
                                    <li class="nk-support-item">
                                        <div class="">
                                            <img id="company_image" class="h-100px" src="{{$project->company->img_url}}" alt="">
                                        </div>
                                        <div class="nk-support-content">
                                            <div class="title">
                                                <span class="fs-5" id="company_name">{{$project->company->name}}</span>
                                                <p id="company_country" class="fs-6">{{$project->company->address->emoji}} {{$project->company->address->country}}</p>
                                            </div>
                                            <p id="company_industry"></p>
                                            <p><i class="fa-regular fa-globe me-1"></i><span id="company_website">{{$project->company->website}}</span></p>
                                            <p><i class="fa-regular fa-calendar me-1"></i><span id="company_establish">{{$project->company->establish}}</span></p>
                                            <p><i class="fa-regular fa-building me-1"></i><span id="company_establish">{{$project->company->type->name}}</span></p>
                                        </div>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
