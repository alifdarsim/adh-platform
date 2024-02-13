@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create Project</h3>
                <div class="nk-block-des text-soft">
                    <p>Create your project and find potential expert will be partner to complete your
                        project.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <form class="nk-stepper stepper-init is-alter nk-stepper-s1" action="#"
                  id="stepper-create-project">
                <div class="row g-0 col-sep col-sep-md col-sep-xl">
                    <div class="col-md-4 col-xl-3">
                        <div class="card-inner">
                            <ul class="nk-stepper-nav nk-stepper-nav-s1 stepper-nav is-vr">
                                <li>
                                    <div class="step-item">
                                        <div class="step-text">
                                            <div class="lead-text">Company</div>
                                            <div class="sub-text">Company for the project</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="step-item">
                                        <div class="step-text">
                                            <div class="lead-text">Project Info</div>
                                            <div class="sub-text">Project information</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="step-item">
                                        <div class="step-text">
                                            <div class="lead-text">Target Partners</div>
                                            <div class="sub-text">Target information</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="step-item">
                                        <div class="step-text">
                                            <div class="lead-text">Completed</div>
                                            <div class="sub-text">Review and Submit</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-xl-9">
                        <div class="card-inner">
                            <div class="nk-stepper-content">
                                <div class="nk-stepper-steps stepper-steps">
                                    <div class="nk-stepper-step">
                                        <h5 class="title mb-4">Client Company information</h5>
                                        <div id="company_section" class="mt-2">
                                            <div class="row g-3">
                                                <div class="col-7">
                                                    <div class="form-group">
                                                        <label class="form-label" for="select_company">Select Company</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select"
                                                                    id="select_company" name="select_company"
                                                                    data-placeholder="Select Company"
                                                                    data-search="on" required>
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                               style="visibility: hidden" for="company">.</label>
                                                        <div class="form-control-wrap">
                                                            <a href="#" class="btn btn-primary">Create
                                                                New Company</a>
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
                                                                    <p><i class="fa-regular fa-globe me-1"></i><span id="company_website"></span></p>
                                                                    <p><i class="fa-regular fa-calendar me-1"></i><span id="company_establish"></span></p>
                                                                </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-stepper-step">
                                        <h5 class="title mb-3">Project Information</h5>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="project-name">Project
                                                        Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                               id="project-name" name="project-name"
                                                               required>
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
                                                                                  required></textarea>
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
                                                            @foreach($hubs as $hub)
                                                                <option value="{{ $hub->id }}">{{ $hub->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="form-group">
                                                    <label class="form-label" for="deadline">Deadline
                                                        Date</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em
                                                                class="icon ni ni-calendar"></em></div>
                                                        <input id="deadline" type="text"
                                                               class="form-control date-picker"
                                                               placeholder="dd/mm/yyyy"
                                                               data-date-format="dd/mm/yyyy" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-stepper-step">
                                        <h5 class="title mb-3">Target Partners</h5>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="target_country">Target
                                                        Country</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" id="target_country" name="target_country"
                                                                multiple="multiple" data-placeholder="Select Target Country"
                                                                data-search="on" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="target_expectation">Expectation for Target Partners</label>
                                                    <div class="form-control-wrap">
                                                        <textarea id="target_expectation" class="form-control" type="text" placeholder="Example: &#13;&#10;1. Will the company can produce noodles with at least 1 ton each month.&#13;&#10;2. Can potential company provide funding at the start the projects? Around 10,000 USD &#13;&#10;3. ...." required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="target_industry">Target Industry Classification</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" id="target_industry" name="target_industry"
                                                                data-placeholder="Select Industry Type" data-search="on" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="target_company_size">Company Size</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="target_company_size"
                                                                name="target_company_size"
                                                                data-placeholder="Select Number of Employee" required>
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
                                            <div class="col-6 mt-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="target_services_tag">Target Product/Service Keyword</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" id="target_services_tag" class="form-control tagify" placeholder="Add Keyword">
                                                    </div>
                                                    <span class="sub-text tw-mt-0.5">Eg: Food Processing, Packaging, Noodles, Mobile Apps</span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="target_others_tag">Others Business Keyword</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" id="target_others_tag" class="form-control tagify" placeholder="Add Keyword">
                                                    </div>
                                                    <span class="sub-text tw-mt-0.5">Eg: Carbon Free, B2B, Manufacturing</span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mt-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="communication_language">Preferred Communication Language</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" id="communication_language" name="communication_language"
                                                                multiple="multiple" data-placeholder="Select Location" data-search="on" required>
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
                                            <div class="col-6 mt-4">
                                                <div class="form-group">
                                                    <label class="form-label">Revenue In
                                                        Million</label>
                                                    <div class="tw-grid tw-grid-cols-2 tw-gap-x-5">
                                                        <div>
                                                            <span class="sub-text">Revenue From</span>
                                                            <div class="form-control-wrap number-spinner-wrap">
                                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus"
                                                                        data-number="minus"><em class="icon ni ni-minus"></em>
                                                                </button>
                                                                <input type="number" class="form-control number-spinner" value="0" id="target_revenue_from">
                                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus"
                                                                        data-number="plus"><em class="icon ni ni-plus"></em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span class="sub-text">Revenue To</span>
                                                            <div class="form-control-wrap number-spinner-wrap">
                                                                <button
                                                                    class="btn btn-icon btn-outline-light number-spinner-btn number-minus"
                                                                    data-number="minus"><em
                                                                        class="icon ni ni-minus"></em>
                                                                </button>
                                                                <input type="number" class="form-control number-spinner" value="0" id="target_revenue_to">
                                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus">
                                                                    <em class="icon ni ni-plus"></em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-stepper-step text-center">
                                        <h5 class="title mb-2">Successfully created!</h5>
                                        <p class="text-soft">Successfully created your project to
                                            kickstart now </p>
                                        <div class="gfx mx-auto">
                                            <img src="/images/svg/deal-create.svg" class="w-50" alt="">
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-stepper-pagination pt-4 gx-4 gy-2 stepper-pagination">
                                    <li class="step-prev">
                                        <button class="btn btn-dim btn-primary">Prev</button>
                                    </li>
                                    <li class="step-next">
                                        <button class="btn btn-primary">Next</button>
                                    </li>
                                    <li class="step-submit">
                                        <button onclick="submitProject()" class="btn btn-primary">Submit</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script>
        // create fake data
        $('#project-name').val('Seeking investor/operator for large-scale noodles company in Thailand');
        $('#project-description').val('One of the noodles company in Thailand is looking to develop a large-scale noodles manufacturing and distribution company in Thailand. Seeking an international strategic partner that would invest $100M+ and operate a 10 million noodle packages per year.');
        $('#hub').val('2');
        $('#deadline').val('16/01/2024');
        $('#target_expectation').html('1. Will the company can produce noodles with at least 1 ton each month.\n2. Can potential company provide funding at the start the projects? Around 10,000 USD\n');
        $('#target_company_size').val('1001-5000');
        $('#communication_language').val(['English', 'Chinese', 'Japanese']);

        tagifyInit();
        function tagifyInit(){
            $('#target_services_tag').tagify({
                maxTags: 20,
            });
            $('#target_others_tag').tagify({
                maxTags: 10,
            });
            $('#target_services_tag').data('tagify').addTags('Noodles, Food Processing, Packaging');
            $('#target_others_tag').data('tagify').addTags('Carbon Free, B2B, Manufacturing');
        }

        $('#select_company').on('select2:select', function (e) {
            $('#company_holder').removeClass('d-none');
            getCompanyDetail(e.params.data.id);
        });

        $('#select_company').select2({
            ajax: {
                url: '{{route('companies.search')}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.map(function (item) {
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

        $('#target_country').select2({
            ajax: {
                url: '{{route('countries.search')}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.emoji + ' ' + item.name + ' ',
                            }
                        }),
                    };
                },
                cache: true,
            },
            placeholder: 'Select Target Country',
        });

        $('#target_industry').select2({
            ajax: {
                url: '{{route('companies.industries.search')}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        }),
                    };
                },
                cache: true
            },
            placeholder: 'Select Industry Type',
        });

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
                onOpen: function () {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: '{{ route('companies.get', '') }}/' + id,
                type: 'GET',
                success: function (data) {
                    //add delay of 500ms then close swal
                    setTimeout(function () {
                        Swal.close();
                        console.log(data)
                        $('#company_name').text(data.name);
                        $('#company_image').attr('src', data.img_url);
                        $('#company_type').text(data.type.name);
                        $('#company_website').text(data.website);
                        $('#company_industry').text(data.industry);
                        $('#company_establish').text(data.establish);
                        $('#company_country').text(getEmojiFlag(data.address.country_code) + ' ' + data.address.country);
                    }, 100);
                }
            });
        }

        function submitProject() {
            Swal.fire({
                text: 'Submit project...',
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
                url: '{{ route('client.projects.store') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    company_id: $('#select_company').val(),
                    name: $('#project-name').val(),
                    description: $('#project-description').val(),
                    hub: $('#hub').val(),
                    deadline: $('#deadline').val(),
                    target_country: $('#target_country').val(),
                    target_expectation: $('#target_expectation').val(),
                    target_industry: $('#target_industry').val(),
                    target_company_size: $('#target_company_size').val(),
                    target_services_tag: $('#target_services_tag').val(),
                    target_others_tag: $('#target_others_tag').val(),
                    communication_language: $('#communication_language').val(),
                    target_revenue_from: $('#target_revenue_from').val(),
                    target_revenue_to: $('#target_revenue_to').val(),
                },
                success: function (data) {
                    //add delay of 500ms then close swal
                    setTimeout(function () {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully created!',
                            text: 'Successfully created your project to kickstart now',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            onOpen: function () {
                                Swal.showLoading();
                            }
                        });
                        setTimeout(function () {
                            Swal.close();
                            window.location.href = '{{route('client.projects.index')}}';
                        }, 1000);
                    }, 100);
                }
            });
        }

    </script>
@endpush



