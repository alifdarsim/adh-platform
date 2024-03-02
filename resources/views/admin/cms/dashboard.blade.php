@extends('layouts.others.main')
@section('content')

{{--    <x-content_header title="CMS Dashboard" subtitle="Welcome to AsiaDealHub CMS Analytics Dashboard."/>--}}

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <ul class="row g-gs preview-icon-svg">
                    <li class="col-lg-3 col-sm-6 col-12">
                        <div class="preview-icon-box card card-bordered">
                            <div class="preview-icon-wrap tw-flex tw-justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="5" y="5" width="53.97" height="69.95" rx="7" ry="7" fill="#e3e7fe"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <path d="M51.66,15H22.4A7.22,7.22,0,0,0,15,22V78a7.21,7.21,0,0,0,7.41,7H61.56A7.2,7.2,0,0,0,69,78V30.5Z"
                                          fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <polyline points="68.96 30.98 51.97 30.91 51.97 15.99" fill="none" stroke="#6576ff"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="23" y1="34" x2="44" y2="34" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="23" y1="42" x2="57" y2="42" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="23" y1="50" x2="57" y2="50" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="23" y1="58" x2="32" y2="58" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <ellipse cx="61.1" cy="61.11" rx="23.9" ry="23.89" fill="#fff" stroke="#6576ff"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <polygon points="69.56 74.43 47.7 52.84 52.46 48.15 74.32 69.74 69.56 74.43"
                                             fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="2"/>
                                    <line x1="54.98" y1="51.16" x2="54.22" y2="51.91" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="57.62" y1="53.77" x2="55.59" y2="55.78" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="71.22" y1="67.2" x2="70.46" y2="67.95" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="68.87" y1="64.88" x2="66.84" y2="66.89" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <path d="M69.55,48.21l5,4.89L55.42,72H51V67.6Z" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="65.67" y1="52.24" x2="70.35" y2="56.86" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>
                            </div>
                            <div><span class="title fw-bold fs-17px">Add New Post</span></div>
                            <a href="{{route('post.show')}}">
                                <button class="btn btn-primary mt-2">Add Post</button>
                            </a>
                        </div><!-- .preview-icon-box -->
                    </li><!-- .col -->
                    <li class="col-lg-3 col-sm-6 col-12">
                        <div class="preview-icon-box card card-bordered">
                            <div class="preview-icon-wrap tw-flex tw-justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="5" y="7" width="60" height="56" rx="7" ry="7" fill="#e3e7fe"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <rect x="25" y="27" width="60" height="56" rx="7" ry="7" fill="#e3e7fe"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <rect x="15" y="17" width="60" height="56" rx="7" ry="7" fill="#fff"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <line x1="15" y1="29" x2="75" y2="29" fill="none" stroke="#6576ff"
                                          stroke-miterlimit="10" stroke-width="2"/>
                                    <circle cx="53" cy="23" r="2" fill="#c4cefe"/>
                                    <circle cx="60" cy="23" r="2" fill="#c4cefe"/>
                                    <circle cx="67" cy="23" r="2" fill="#c4cefe"/>
                                    <rect x="22" y="39" width="20" height="20" rx="2" ry="2" fill="none"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <circle cx="32" cy="45.81" r="2" fill="none" stroke="#6576ff" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"/>
                                    <path d="M29,54.31a3,3,0,0,1,6,0" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="40" x2="69" y2="40" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="51" x2="69" y2="51" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="57" x2="59" y2="57" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="64" y1="57" x2="66" y2="57" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="46" x2="59" y2="46" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="64" y1="46" x2="66" y2="46" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="tw-flex tw-items-center tw-justify-center"><span class="title fw-bold fs-17px ">Post List</span><span
                                        class="ms-1 fw-medium badge badge-dim bg-primary">12</span></div>
                            <a href="{{route('post.show')}}">
                                <button class="btn btn-primary mt-2">Manage Posts</button>
                            </a>
                        </div><!-- .preview-icon-box -->
                    </li><!-- .col -->
                    <li class="col-lg-3 col-sm-6 col-12">
                        <div class="preview-icon-box card card-bordered">
                            <div class="preview-icon-wrap tw-flex tw-justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="5" y="7" width="60" height="56" rx="7" ry="7" fill="#e3e7fe"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <rect x="25" y="27" width="60" height="56" rx="7" ry="7" fill="#e3e7fe"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <rect x="15" y="17" width="60" height="56" rx="7" ry="7" fill="#fff"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <line x1="15" y1="29" x2="75" y2="29" fill="none" stroke="#6576ff"
                                          stroke-miterlimit="10" stroke-width="2"/>
                                    <circle cx="53" cy="23" r="2" fill="#c4cefe"/>
                                    <circle cx="60" cy="23" r="2" fill="#c4cefe"/>
                                    <circle cx="67" cy="23" r="2" fill="#c4cefe"/>
                                    <rect x="22" y="39" width="20" height="20" rx="2" ry="2" fill="none"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <circle cx="32" cy="45.81" r="2" fill="none" stroke="#6576ff" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"/>
                                    <path d="M29,54.31a3,3,0,0,1,6,0" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="40" x2="69" y2="40" fill="none" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="51" x2="69" y2="51" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="57" x2="59" y2="57" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="64" y1="57" x2="66" y2="57" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="49" y1="46" x2="59" y2="46" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line x1="64" y1="46" x2="66" y2="46" fill="none" stroke="#c4cefe"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="tw-flex tw-items-center tw-justify-center"><span class="title fw-bold fs-17px ">Tag List</span><span
                                        class="ms-1 fw-medium badge badge-dim bg-primary">12</span></div>
                            <a href="{{route('tags.show')}}">
                                <button class="btn btn-primary mt-2">Edit Tags</button>
                            </a>
                        </div><!-- .preview-icon-box -->
                    </li><!-- .col -->
                    <li class="col-lg-3 col-sm-6 col-12">
                        <div class="preview-icon-box card card-bordered">
                            <div class="preview-icon-wrap tw-flex tw-justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="15" y="5" width="56" height="70" rx="6" ry="6" fill="#e3e7fe"
                                          stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <path d="M69.88,85H30.12A6.06,6.06,0,0,1,24,79V21a6.06,6.06,0,0,1,6.12-6H59.66L76,30.47V79A6.06,6.06,0,0,1,69.88,85Z"
                                          fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"/>
                                    <polyline points="60 16 60 31 75 31.07" fill="none" stroke="#6576ff"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <rect x="40" y="45" width="23" height="19" fill="#e3e7fe" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <rect x="36" y="49" width="23" height="19" fill="#fff" stroke="#6576ff"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <polyline points="37 62.88 45.12 55.94 52.81 63.06 55.99 59.44 59 62.76" fill="none"
                                              stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"/>
                                    <circle cx="52.11" cy="54.98" r="2.02" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="tw-flex tw-items-center tw-justify-center"><span class="title fw-bold fs-17px ">Authors</span><span
                                        class="ms-1 fw-medium badge badge-dim bg-primary">12</span></div>
                            <a href="{{route('authors.show')}}">
                                <button class="btn btn-primary mt-2">View Authors</button>
                            </a>
                        </div><!-- .preview-icon-box -->
                    </li><!-- .col -->
                </ul><!-- .row -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div>

@endsection
