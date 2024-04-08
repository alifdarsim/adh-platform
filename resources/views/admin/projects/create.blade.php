@extends('layouts.admin.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create Project on Behalf Client</h3>
                <div class="nk-block-des text-soft">
                    <p>Create your project and find potential expert will be partnered to complete your project.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="title">1. Client Company information</h5>
                <div id="company_section" class="mt-2">
                    <div class="row g-3">
                        <div class="col-7">
                            <div class="form-group">
                                <label class="form-label" for="select_company">Create project on behalf of which
                                    company?</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="select_company" name="select_company"
                                        data-placeholder="Search Company Database" data-search="on" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label class="form-label" style="visibility: hidden" for="company">.</label>
                                <div class="form-control-wrap">
                                    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Register New
                                        Company</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="px-0 d-none" id="company_holder">
                                <h6 class="overline-title mb-2">Company Information</h6>
                                <div class="card bg-white">
                                    <li class="nk-support-item">
                                        <div class="">
                                            <img id="company_image" class="h-100px" src="" alt="">
                                        </div>
                                        <div class="nk-support-content">
                                            <div class="title">
                                                <span class="fs-5" id="company_name"></span>
                                                <p id="company_country" class="fs-6"></p>
                                            </div>
                                            <p id="company_industry"></p>
                                            <p><i class="fa-regular fa-globe me-1"></i><span id="company_website"></span>
                                            </p>
                                            <p><i class="fa-regular fa-calendar me-1"></i><span
                                                    id="company_establish"></span></p>
                                        </div>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-bordered mt-2">
            <div class="card-inner">
                <h5 class="title mb-3">2. Project Information</h5>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="project-name">Project Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="project-name" name="project-name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="project-description">Project
                                Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm" id="project-description" name="project-description"
                                    placeholder="Write Project Description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label class="form-label" for="hub">Hub Type</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="hub" name="hub"
                                    data-placeholder="Select Hub Type" data-search="on" required>
                                    <option value=""></option>
                                    @foreach ($hubs as $hub)
                                        <option value="{{ $hub->id }}">{{ $hub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label class="form-label" for="deadline">Deadline Date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                <input id="deadline" type="text" class="form-control date-picker"
                                    placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-bordered mt-2">
            <div class="card-inner">
                <h5 class="title mb-3">3. Target Partners Information </h5>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="target_country">Target Country<span class="text-danger">
                                    *</span></label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="target_country" name="target_country"
                                    multiple="multiple" data-placeholder="Select Target Country" data-search="on"
                                    required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="target_company_size">Target Company Size</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="target_company_size"
                                    name="target_company_size" data-placeholder="Select Number of Employee" required>
                                    <option value=""></option>
                                    <option value="1-10">1-10</option>
                                    <option value="11-50">11-50</option>
                                    <option value="51-200">51-200</option>
                                    <option value="201-500">201-500</option>
                                    <option value="501-1000">501-1000</option>
                                    <option value="1001-5000">1001-5000</option>
                                    <option value="5001-10000">5001-10000</option>
                                    <option value="10000+">10000+</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
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
                    {{--                    <div class="col-6"> --}}
                    {{--                        <div class="form-group"> --}}
                    {{--                            <label class="form-label" for="target_industry">Target Industry Classification<span class="text-danger"> *</span></label> --}}
                    {{--                            <div class="form-control-wrap"> --}}
                    {{--                                <select class="form-select" id="target_industry" name="target_industry" --}}
                    {{--                                        data-placeholder="Select Industry Type" data-search="on" required> --}}
                    {{--                                    <option value=""></option> --}}
                    {{--                                </select> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    <div class="col-6 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="communication_language">Preferred Communication
                                Language</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="communication_language"
                                    name="communication_language" multiple="multiple" data-placeholder="Select Language"
                                    data-search="on" required>
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
                            <label class="form-label" for="target_keyword">Target Product/Service/Industry Keyword<i
                                    class="fs-6 ms-1 text-info fa-solid fa-info-circle" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="These keyword will be use to match the best potential partners for this project. (Max. 20 keyword)"></i></label>
                            <div class="form-control-wrap">
                                <input type="text" id="target_keyword" class="form-control tagify"
                                    placeholder="Add Keyword">
                            </div>
                            <span class="sub-text tw-mt-0.5">Eg: Food Processing, Packaging, Noodles, Mobile Apps</span>
                        </div>
                    </div>
                    <div class="col-12 mt-4 mb-2">
                        <div class="form-control-wrap">
                            <label class="form-label" for="target_industry">Key Questions to Potential Partner (Leave
                                empty if no question)<i class="fs-6 ms-1 text-info fa-solid fa-info-circle"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="A set of questions that will be asked to a potential partners before they will be match as potential partner"></i></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Q1</span></div>
                                <input type="text" id="q1" class="form-control target_question"
                                    placeholder="Eg: Care to share your portfolio?" required="">
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q2</span></div>
                                <input type="text" id="q2" class="form-control target_question"
                                    placeholder="Eg: Which sector is the customer base and who is the major clients?"
                                    required="">
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q3</span></div>
                                <input type="text" id="q3" class="form-control target_question"
                                    placeholder="Eg: Are you able to buy at least 2 units of the machine to start demonstration and distribution (value at least USD 50,000)"
                                    required="">
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q4</span></div>
                                <input type="text" id="q4" class="form-control target_question"
                                    placeholder="Eg: What is the company revenue for past 5 year" required="">
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">Q5</span></div>
                                <input type="text" id="q4" class="form-control target_question"
                                    placeholder="Eg: What is the main key products your company sells" required="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="title">4. Submit Project</h5>
                <div class="col-6 pt-3">
                    <div class="form-group tw-flex tw-justify-items-center">
                        <label class="form-label mt-1 me-2 tw-cursor-default" for="owner">Project Created By: </label>
                        <input type="text" class="ps-2 tw-w-72" id="owner" name="project-name"
                            value="{{ auth()->user()->name }}" disabled required>
                    </div>
                </div>
                <div class="col-4">
                    <btn class="btn btn-primary mt-3 btn-block" onclick="submitProject()">Submit Project</btn>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>

    <script>
        // create fake data
        // function initFakeData(){
        //     $('#project-name').val('Seeking investor/operator for large-scale noodles company in Thailand');
        //     $('#project-description').val('One of the noodles company in Thailand is looking to develop a large-scale noodles manufacturing and distribution company in Thailand. Seeking an international strategic partner that would invest $100M+ and operate a 10 million noodle packages per year.');
        //     $('#hub').val('2').trigger('change');
        //     $('#deadline').datepicker('setDate', new Date(new Date().getFullYear(), new Date().getMonth() + 3, new Date().getDate()));
        //     $('#target_company_size').val('1001-5000').trigger('change');
        //     $('#communication_language').val(['English', 'Chinese', 'Japanese']).trigger('change');
        //     $('#target_industry').val('1').trigger('change');
        //     $('#target_country').val(['1', '2', '3']).trigger('change');
        //     $('#target_keyword').data('tagify').addTags('Noodles, Food Processing, Packaging');
        //     $('#q1').val('What is the main key products your company sells?');
        // }

        $('#deadline').datepicker('setDate', new Date(new Date().getFullYear(), new Date().getMonth() + 3, new Date()
            .getDate()));
        tagifyInit();

        function tagifyInit() {
            $('#target_keyword').tagify({
                maxTags: 20,
            });
        }

        $('#select_company').on('select2:select', function(e) {
            $('#company_holder').removeClass('d-none');
            getCompanyDetail(e.params.data.id);
        });

        $('#select_company').select2({
            ajax: {
                url: '{{ route('company.search') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        query: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name,
                                img: item.img_url
                            }
                        }),
                    };
                },
                cache: true
            },
            placeholder: 'Search company...',
            minimumInputLength: 1,
            templateResult: formatResult,
            templateSelection: formatSelection,
        });

        initCountry();

        function initCountry() {
            $.ajax({
                url: '{{ route('countries.index') }}',
                dataType: 'json',
                success: function(data) {
                    $('#target_country').select2({
                        data: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.emoji + ' ' + item.name + ' ',
                            }
                        }),
                        placeholder: 'Select Target Country',
                    });
                }

            });
        }

        initIndustry();

        function initIndustry() {
            $.ajax({
                url: '{{ route('industries.index') }}',
                dataType: 'json',
                success: function(data) {
                    $('#target_industry').select2({
                        data: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        }),
                        placeholder: 'Select Industry Type',
                    });
                    // initFakeData();
                }

            });
        }

        function formatResult(result) {
            if (!result.id) return result.text;
            return $(
                '<div class="select2-result">' +
                '<img class="select2-result__image me-2 h-2rem" src="' + result.img + '">' +
                '<span class="select2-result__text">' + result.text + '</span>' +
                '</div>'
            );
        }

        function formatSelection(result) {
            if (!result.id) return result.text;
            return $(
                '<div class="select2-result">' +
                '<img class="select2-result__image me-1 h-1rem" src="' + result.img + '">' +
                '<span class="select2-result__text">' + result.text + '</span>' +
                '</div>'
            );
        }

        function getCompanyDetail(id) {
            // add swal loading here
            Swal.fire({
                text: 'Get company details...',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                onOpen: function() {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: '{{ route('companies.get', '') }}/' + id,
                type: 'GET',
                success: function(data) {
                    //add delay of 500ms then close swal
                    setTimeout(function() {
                        Swal.close();
                        $('#company_name').text(data.name);
                        $('#company_image').attr('src', data.img_url);
                        $('#company_type').text(data.type.name);
                        $('#company_website').text(data.website);
                        $('#company_industry').text(data.industry);
                        $('#company_establish').text(data.establish);
                        $('#company_country').text(data.address.country);
                    }, 100);
                }
            });
        }

        function submitProject() {
            let keywords = $('#target_keyword').val();
            if (keywords.length < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'At least a keyword is needed for project creation',
                });
                return;
            }
            Swal.fire({
                text: 'Submit project...',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                onOpen: function() {
                    Swal.showLoading();
                }
            });
            // get target keyword values, then convert to array
            $.ajax({
                url: '{{ route('admin.projects.store') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    company_id: $('#select_company').val(),
                    name: $('#project-name').val(),
                    description: $('#project-description').val(),
                    hub: $('#hub').val(),
                    deadline: $('#deadline').val(),
                    target_country: $('#target_country').val(),
                    target_industry: $('#sub-industry').val(),
                    target_company_size: $('#target_company_size').val(),
                    target_keyword: JSON.parse($('#target_keyword').val()).map(e => e.value),
                    communication_language: $('#communication_language').val(),
                    target_question: $('.target_question').map(function() {
                        return $(this).val();
                    }).get(),
                },
                success: function(data) {
                    //add delay of 500ms then close swal
                    setTimeout(function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully created!',
                            text: 'Successfully created your project. You will be redirect to project page.',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        });
                        setTimeout(function() {
                            Swal.close();
                            window.location.href = '{{ route('admin.projects.index') }}';
                        }, 1000);
                    }, 100);
                },
                error: function(data) {
                    console.log(data)
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.responseJSON.message,
                    });
                }
            });
        }

        $(document).ready(function() {
            $.ajax({
                url: '{{ route('industries_expert.main') }}',
                method: 'GET',
                success: function(response) {
                    response.forEach(function(industry) {
                        $('#main-industry').append('<option value="' + industry + '">' +
                            industry + '</option>');
                    });
                }
            });
        });

        let sub_industry_classification;
        $('#main-industry').on('change', function() {
            let main = $(this).val();
            if (main === null) return;
            main = main.replaceAll('/', '_');
            $.ajax({
                url: '{{ route('industries_expert.sub', '') }}/' + main,
                method: 'GET',
                success: function(response) {
                    $('#sub-industry').empty();
                    response.forEach(function(industry) {
                        $('#sub-industry').append('<option value="' + industry.id + '">' +
                            industry.sub + '</option>');
                    });
                    if (sub_industry_classification) {
                        $('#sub-industry').val(sub_industry_classification).trigger('change');
                    }
                }
            });
        });
    </script>
@endpush
