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
{{--            <div class="tab-pane" id="tabItem8" role="tabpanel">--}}
{{--                <div id="company_section" class="mt-2">--}}
{{--                    <div class="row g-3">--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="px-0" id="company_holder">--}}
{{--                                <div class="nk-fmg-listing nk-block-lg">--}}
{{--                                    <div class="nk-block-head-xs">--}}
{{--                                        <div class="nk-block-between g-2">--}}
{{--                                            <div class="nk-block-head-content">--}}
{{--                                                <h6 class="nk-block-title title">Related Documents</h6>--}}
{{--                                            </div>--}}
{{--                                            <div class="nk-block-head-content">--}}
{{--                                                <ul class="nk-block-tools g-3 nav">--}}
{{--                                                    <li><a data-bs-toggle="tab" href="#file-grid-view" class="nk-switch-icon active"><em class="icon ni ni-view-grid3-wd"></em></a></li>--}}
{{--                                                    <li><a data-bs-toggle="tab" href="#file-group-view" class="nk-switch-icon"><em class="icon ni ni-view-group-wd"></em></a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .nk-block-head -->--}}
{{--                                    <div class="tab-content">--}}
{{--                                        <div class="tab-pane active" id="file-grid-view">--}}
{{--                                            <div class="nk-files nk-files-view-grid">--}}
{{--                                                <div class="nk-files-list">--}}
{{--                                                    <div class="nk-file-item nk-file">--}}
{{--                                                        <div class="nk-file-info">--}}
{{--                                                            <div class="nk-file-title">--}}
{{--                                                                <div class="nk-file-icon">--}}
{{--                                                                    <a class="nk-file-icon-link" href="#">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <g>--}}
{{--                                                                                            <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                            <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                            <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                            <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="36" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="41" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="46" width="12" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                        </g>--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </a>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="nk-file-name">--}}
{{--                                                                    <div class="nk-file-name-text">--}}
{{--                                                                        <a href="#" class="title">Quotation.doc</a>--}}
{{--                                                                        <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <ul class="nk-file-desc">--}}
{{--                                                                <li class="date">06 Jan</li>--}}
{{--                                                                <li class="size">1.2 MB</li>--}}
{{--                                                                <li class="members">3 Members</li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="nk-file-actions">--}}
{{--                                                            <div class="dropdown">--}}
{{--                                                                <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                    <ul class="link-list-plain no-bdr">--}}
{{--                                                                        <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                        <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                        <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                        <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                        <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                        <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                    </ul>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div><!-- .nk-file -->--}}
{{--                                                    <div class="nk-file-item nk-file">--}}
{{--                                                        <div class="nk-file-info">--}}
{{--                                                            <div class="nk-file-title">--}}
{{--                                                                <div class="nk-file-icon">--}}
{{--                                                                    <a class="nk-file-icon-link" href="#">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="35" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="39" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="43" width="14" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="47" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </a>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="nk-file-name">--}}
{{--                                                                    <div class="nk-file-name-text">--}}
{{--                                                                        <a href="#" class="title">Work-to-do.txt</a>--}}
{{--                                                                        <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <ul class="nk-file-desc">--}}
{{--                                                                <li class="date">06 Jan</li>--}}
{{--                                                                <li class="size">525 Kb</li>--}}
{{--                                                                <li class="members">3 Members</li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="nk-file-actions">--}}
{{--                                                            <div class="dropdown">--}}
{{--                                                                <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                    <ul class="link-list-plain no-bdr">--}}
{{--                                                                        <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View</span></a></li>--}}
{{--                                                                        <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy Link</span></a></li>--}}
{{--                                                                    </ul>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="tab-pane" id="file-group-view">--}}
{{--                                            <div class="nk-files nk-files-view-group">--}}
{{--                                                <div class="nk-files-group">--}}
{{--                                                    <div class="nk-files-list">--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <path d="M42,31H30a3.0033,3.0033,0,0,0-3,3V45a3.0033,3.0033,0,0,0,3,3H42a3.0033,3.0033,0,0,0,3-3V34A3.0033,3.0033,0,0,0,42,31ZM29,38h6v3H29Zm8,0h6v3H37Zm6-4v2H37V33h5A1.001,1.001,0,0,1,43,34ZM30,33h5v3H29V34A1.001,1.001,0,0,1,30,33ZM29,45V43h6v3H30A1.001,1.001,0,0,1,29,45Zm13,1H37V43h6v2A1.001,1.001,0,0,1,42,46Z" style="fill:#36c684" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">Database.xlsx</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">Today</li>--}}
{{--                                                                    <li class="size">235 KB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <g>--}}
{{--                                                                                            <rect x="18" y="16" width="36" height="40" rx="5" ry="5" style="fill:#e3edfc" />--}}
{{--                                                                                            <path d="M19.03,54A4.9835,4.9835,0,0,0,23,56H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                            <rect x="32" y="20" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <rect x="32" y="25" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <rect x="32" y="30" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <rect x="32" y="35" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <path d="M35,16.0594h2a0,0,0,0,1,0,0V41a1,1,0,0,1-1,1h0a1,1,0,0,1-1-1V16.0594A0,0,0,0,1,35,16.0594Z" style="fill:#7e95c4" />--}}
{{--                                                                                            <path d="M38.0024,40H33.9976A1.9976,1.9976,0,0,0,32,41.9976v2.0047A1.9976,1.9976,0,0,0,33.9976,46h4.0047A1.9976,1.9976,0,0,0,40,44.0024V41.9976A1.9976,1.9976,0,0,0,38.0024,40Zm-.0053,4H34V42h4Z" style="fill:#7e95c4" />--}}
{{--                                                                                        </g>--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">dashlite...1.2.zip</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">03 May</li>--}}
{{--                                                                    <li class="size">235 KB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <g>--}}
{{--                                                                                            <rect x="18" y="16" width="36" height="40" rx="5" ry="5" style="fill:#e3edfc" />--}}
{{--                                                                                            <path d="M19.03,54A4.9835,4.9835,0,0,0,23,56H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                            <rect x="32" y="20" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <rect x="32" y="25" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <rect x="32" y="30" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <rect x="32" y="35" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                            <path d="M35,16.0594h2a0,0,0,0,1,0,0V41a1,1,0,0,1-1,1h0a1,1,0,0,1-1-1V16.0594A0,0,0,0,1,35,16.0594Z" style="fill:#7e95c4" />--}}
{{--                                                                                            <path d="M38.0024,40H33.9976A1.9976,1.9976,0,0,0,32,41.9976v2.0047A1.9976,1.9976,0,0,0,33.9976,46h4.0047A1.9976,1.9976,0,0,0,40,44.0024V41.9976A1.9976,1.9976,0,0,0,38.0024,40Zm-.0053,4H34V42h4Z" style="fill:#7e95c4" />--}}
{{--                                                                                        </g>--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">covstats.zip</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">01 May</li>--}}
{{--                                                                    <li class="size">235 KB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <g>--}}
{{--                                                                                            <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                            <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                            <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                            <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="36" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="41" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="46" width="12" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                        </g>--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">Price List.doc</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">25 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <g>--}}
{{--                                                                                            <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                            <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                            <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                            <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="36" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="41" width="18" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                            <rect x="27" y="46" width="12" height="2" rx="1" ry="1" style="fill:#599def" />--}}
{{--                                                                                        </g>--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">Quotation.doc</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">06 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="35" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="39" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="43" width="14" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                        <rect x="27" y="47" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">Work-to-do.txt</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">02 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <path d="M27.2223,43H44.7086s2.325-.2815.7357-1.897l-5.6034-5.4985s-1.5115-1.7913-3.3357.7933L33.56,40.4707a.6887.6887,0,0,1-1.0186.0486l-1.9-1.6393s-1.3291-1.5866-2.4758,0c-.6561.9079-2.0261,2.8489-2.0261,2.8489S25.4268,43,27.2223,43Z" style="fill:#755de0" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">DashLite_v1.psd</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">02 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <path d="M46,46.5v-13A3.5042,3.5042,0,0,0,42.5,30h-13A3.5042,3.5042,0,0,0,26,33.5v13A3.5042,3.5042,0,0,0,29.5,50h13A3.5042,3.5042,0,0,0,46,46.5ZM40,45v3H37V45Zm-3-2V37h7v6Zm0-8V32h3v3Zm-2-3v3H32V32Zm0,5v6H28V37Zm0,8v3H32V45Zm7.5,3H42V45h2v1.5A1.5016,1.5016,0,0,1,42.5,48ZM44,33.5V35H42V32h.5A1.5016,1.5016,0,0,1,44,33.5ZM29.5,32H30v3H28V33.5A1.5016,1.5016,0,0,1,29.5,32ZM28,46.5V45h2v3h-.5A1.5016,1.5016,0,0,1,28,46.5Z" style="fill:#f74141" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">New Movie.mp4</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">02 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <path d="M42,31H30a3.0033,3.0033,0,0,0-3,3V45a3.0033,3.0033,0,0,0,3,3H42a3.0033,3.0033,0,0,0,3-3V34A3.0033,3.0033,0,0,0,42,31ZM29,38h6v3H29Zm8,0h6v3H37Zm6-4v2H37V33h5A1.001,1.001,0,0,1,43,34ZM30,33h5v3H29V34A1.001,1.001,0,0,1,30,33ZM29,45V43h6v3H30A1.001,1.001,0,0,1,29,45Zm13,1H37V43h6v2A1.001,1.001,0,0,1,42,46Z" style="fill:#36c684" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">Project List.xls</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">02 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div><!-- .nk-file -->--}}
{{--                                                        <div class="nk-file-item nk-file">--}}
{{--                                                            <div class="nk-file-info">--}}
{{--                                                                <div class="nk-file-title">--}}
{{--                                                                    <div class="nk-file-icon">--}}
{{--                                                                                <span class="nk-file-icon-type">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">--}}
{{--                                                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />--}}
{{--                                                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />--}}
{{--                                                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />--}}
{{--                                                                                        <path d="M44.1405,46H27.8595A1.86,1.86,0,0,1,26,44.1405V34.8595A1.86,1.86,0,0,1,27.8595,33H44.14A1.86,1.86,0,0,1,46,34.86v9.2808A1.86,1.86,0,0,1,44.1405,46ZM29.1454,44H42.8546A1.1454,1.1454,0,0,0,44,42.8546V36.1454A1.1454,1.1454,0,0,0,42.8546,35H29.1454A1.1454,1.1454,0,0,0,28,36.1454v6.7093A1.1454,1.1454,0,0,0,29.1454,44Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M36.4218,34.268a.7112.7112,0,0,1-.5048-.2093l-2.1431-2.1428a.7143.7143,0,0,1,1.01-1.01l2.1428,2.1431a.7142.7142,0,0,1-.5051,1.2192Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M36.4218,34.268a.7142.7142,0,0,1-.5048-1.2192L38.06,30.9057a.7141.7141,0,0,1,1.01,1.01l-2.1426,2.1428A.7113.7113,0,0,1,36.4218,34.268Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M32.1356,49.268a.7054.7054,0,0,1-.3665-.102.7145.7145,0,0,1-.2451-.98l2.1431-3.5713a.7142.7142,0,0,1,1.2247.735l-2.1426,3.5711A.7144.7144,0,0,1,32.1356,49.268Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M40.7083,49.268a.7138.7138,0,0,1-.6129-.3463L37.9526,45.35a.7143.7143,0,0,1,1.225-.735L41.32,48.1866a.7137.7137,0,0,1-.6121,1.0814Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M35.12,37H30.9a.5007.5007,0,1,1,0-1h4.22a.5007.5007,0,1,1,0,1Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M41.9758,43H37.5471a.5056.5056,0,1,1,0-1.0065h4.4286a.5056.5056,0,1,1,0,1.0065Z" style="fill:#f25168" />--}}
{{--                                                                                        <path d="M38.14,40H33.9775a.5.5,0,1,1,0-1H38.14a.5.5,0,1,1,0,1Z" style="fill:#f25168" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="nk-file-name">--}}
{{--                                                                        <div class="nk-file-name-text">--}}
{{--                                                                            <a href="#" class="title">Presentation.ppt</a>--}}
{{--                                                                            <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="nk-file-desc">--}}
{{--                                                                    <li class="date">02 Apr</li>--}}
{{--                                                                    <li class="size">23 MB</li>--}}
{{--                                                                    <li class="members">3 Members</li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="nk-file-actions">--}}
{{--                                                                <div class="dropdown">--}}
{{--                                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>--}}
{{--                                                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                                        <ul class="link-list-plain no-bdr">--}}
{{--                                                                            <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>--}}
{{--                                                                            <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>--}}
{{--                                                                            <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>--}}
{{--                                                                            <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>--}}
{{--                                                                            <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>--}}
{{--                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
