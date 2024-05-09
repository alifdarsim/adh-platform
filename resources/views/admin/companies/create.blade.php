@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create New Company Database</h3>
                <div class="nk-block-des text-soft">
                    <p>Feed AsiaDealHub database with company information that will be used for other part of the system.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a data-bs-toggle="modal" href="#modal-linkedin-prefill" class="btn btn-info"><i class="fa-brands fa-linkedin me-1 fs-5"></i><span>Pre-fill using LinkedIn</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="data-head">
                                <h6 class="overline-title">COMPANY PROFILE</h6>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="tw-flex">
                                <div class="mx-5">
                                    <img src="/images/no-company.png" id="company_image" alt="" class="tw-h-[160px] !tw-w-[160px]">
                                    <a onclick="changeImage()" class="btn btn-sm btn-outline-primary !tw-w-[160px] center mt-1"><i class="fa-regular fa-camera me-1"></i>Change Image</a>
                                </div>
                                <div class="row tw-w-full">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="company_name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="company_name" placeholder="Eg: Asia Deal Hub">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="form-group">
                                            <label class="form-label" for="company_slogan">Slogan</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="company_slogan" placeholder="Eg: Expert based Research & Cross Border Business Matching, Sourcing and Transaction">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="data-head">
                                <h6 class="overline-title">BASIC INFORMATION</h6>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="company_website">Company Website</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="company_website" placeholder="Eg: https://asiadealhub.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="linkedin_url">LinkedIn URL</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="linkedin_url" placeholder="Eg: https://www.linkedin.com/company/asiadealhub">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="company_type">Company Type</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="company_type" name="company_type" data-placeholder="Select Company Type" data-search="on" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="company_establish">Year Establish</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    <input id="company_establish" type="text" class="form-control date-picker" placeholder="Eg: 2005" data-date-format="yyyy" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="company_size">Company Size</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="company_size" placeholder="Eg: 11-50">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="about">About Company</label>
                                <div class="form-control-wrap">
                                    <textarea id="about" class="form-control" type="text" placeholder="Eg: John Metal Trading Pte Ltd is a dynamic and innovative metal trading company based in Singapore. With over two decades of experience in the industry, we have established ourselves as a trusted partner for businesses seeking top-quality metal products and exceptional customer service. Our mission is to provide our clients with the highest quality metal products, exceptional service, and competitive pricing. We are committed to forging long-lasting partnerships with our customers, suppliers, and stakeholders." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data-head">
                                <h6 class="overline-title">INDUSTRY CLASSIFICATION AND RELEVANT KEYWORD</h6>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="form-group">
                                <label class="form-label" for="main-industry">Main Industry Classification</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 select2-hidden-accessible" id="main-industry">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="form-group">
                                <label class="form-label" for="sub-industry">Sub Industry Classification</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 select2-hidden-accessible" id="sub-industry">
                                    </select>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-7 mt-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="industry_classification">Industries</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <select class="form-select js-select2" id="industry_classification" name="industry_classification" data-placeholder="Select Industries" data-search="on" required>--}}
{{--                                        <option value=""></option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="specialties_keyword">Specialities (Max: 20 Keyword)</label>
                                <div class="form-control-wrap">
                                    <input type="text" id="specialties_keyword" class="form-control tagify" placeholder="Add Keyword">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="other_keyword">Others (Max: 10 Keyword)</label>
                                <div class="form-control-wrap">
                                    <input type="text" id="other_keyword" class="form-control tagify" placeholder="Add Keyword">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data-head">
                                <h6 class="overline-title">PIC CONTACT</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="pic_name">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pic_name" placeholder="Eg: Micheal John">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="pic_position">Position</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pic_position" placeholder="Eg: CEO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="pic_contact">Contact</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pic_contact" placeholder="Eg: +60123456789">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="pic_email">Email</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pic_email" placeholder="Eg: contact@johnmetaltrading.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data-head">
                                <h6 class="overline-title">ADDRESS</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="address1">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="address1" placeholder="Eg: 123 Main St">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="postal">Postal Code</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="postal" placeholder="Eg: 10001">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="city">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="city" placeholder="Eg: New York">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="state">State</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="state" placeholder="Eg: NY">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="country">Country</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="country" name="country" data-placeholder="Select Country" data-search="on" required>
{{--                                        <option value=""></option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-12">--}}
{{--                            <div class="data-head">--}}
{{--                                <h6 class="overline-title">FINANCIAL INFORMATION</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Revenue In Million</label>--}}
{{--                                <div class="form-control-wrap number-spinner-wrap">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>--}}
{{--                                    <input type="number" id="revenue" class="form-control number-spinner" value="" placeholder="Not Set">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Operating Profits In Million</label>--}}
{{--                                <div class="form-control-wrap number-spinner-wrap">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>--}}
{{--                                    <input type="number" id="operating_profit" class="form-control number-spinner" value="" placeholder="Not Set">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Net Profits In Million</label>--}}
{{--                                <div class="form-control-wrap number-spinner-wrap">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>--}}
{{--                                    <input type="number" id="net_profit" class="form-control number-spinner" value="" placeholder="Not Set">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Total Assets In Million</label>--}}
{{--                                <div class="form-control-wrap number-spinner-wrap">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>--}}
{{--                                    <input type="number" id="total_assets" class="form-control number-spinner" value="" placeholder="Not Set">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Current Market Capital In Million</label>--}}
{{--                                <div class="form-control-wrap number-spinner-wrap">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>--}}
{{--                                    <input type="number" id="current_market_capital" class="form-control number-spinner" value="" placeholder="Not Set">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Capital</label>--}}
{{--                                <div class="form-control-wrap number-spinner-wrap">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>--}}
{{--                                    <input type="number" id="capital" class="form-control number-spinner" value="" placeholder="Not Set">--}}
{{--                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-sm-12 mt-5">
                            <div class="form-group">
{{--                                <a onclick="draftCompany()" class="btn btn-light px-5">Save To Draft</a>--}}
                                <a onclick="registerCompany()" class="btn btn-primary px-5">Register New Company</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-linkedin-prefill">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title">LinkedIn Basic Company Information</h5>
                    <div class="text-soft mb-3">
                        <p>* Prefill some part of the form using public information from LinkedIn.</p>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label class="form-label" for="linked-url">Company LinkedIn URL</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="linked-url" value="https://www.linkedin.com/company/aibots" placeholder="Example: https://www.linkedin.com/company/asiadealhub">
                            </div>
                            <button class="btn btn-primary mt-2 btn-block me-5" onclick="prefillLinkedIn()">Prefill Company Data</button>
                        </div>
                    </div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->
@endsection

@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script>
        tagifyInit();
        function tagifyInit(){
            $('#specialties_keyword').tagify({
                maxTags: 20,
            });
            $('#other_keyword').tagify({
                maxTags: 10,
            });
        }

        setCountry();
        function setCountry(){
            $.ajax({
                url: '{{route('countries.index')}}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let html = '<option value=""></option>';
                    $.each(data, function (index, value) {
                        html += '<option value="'+value.name+'">'+value.emoji + ' ' +value.name+'</option>';
                    });
                    $('#country').html(html);
                }
            });
        }

        setCompanyType();
        function setCompanyType(){
            $.ajax({
                url: '{{route('company.types')}}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let html = '<option value=""></option>';
                    $.each(data, function (index, value) {
                        html += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    $('#company_type').html(html);
                }
            });
        }

        $( document ).ready(function() {
            $.ajax({
                url: '{{route('industries_expert.main')}}',
                method: 'GET',
                success: function (response) {
                    response.forEach(function (industry) {
                        $('#main-industry').append('<option value="'+industry+'">'+industry+'</option>');
                    });
                }
            });
        });

        let sub_industry_classification;
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
                    if (sub_industry_classification) {
                        $('#sub-industry').val(sub_industry_classification).trigger('change');
                    }
                }
            });
        });

        function registerCompany(){
            let company_name = $('#company_name').val();
            let company_image =  $('#company_image').attr('src');
            let linkedin_vanity =  $('#linkedin_url').val();
            let company_slogan = $('#company_slogan').val();
            let company_website = $('#company_website').val();
            let company_type = $('#company_type').val();
            let company_establish = $('#company_establish').val();
            let company_size = $('#company_size').val();
            let about = $('#about').val();
            let pic_contact = $('#pic_contact').val();
            let pic_email = $('#pic_email').val();
            let sub_industry = $('#sub-industry').val();
            let address = $('#address').val();
            let postal = $('#postal').val();
            let city = $('#city').val();
            let state = $('#state').val();
            let country = $('#country').val();
            let revenue = $('#revenue').val();
            let operating_profit = $('#operating_profit').val();
            let net_profit = $('#net_profit').val();
            let total_assets = $('#total_assets').val();
            let current_market_capital = $('#current_market_capital').val();
            let capital = $('#capital').val();
            let specialties_keyword = $('#specialties_keyword').val();
            let other_keyword = $('#other_keyword').val();
            _Swal.loading('Loading...', 'Registering new company...');
            // console.log(JSON.parse(specialties_keyword).map(item => item.value));
            $.ajax({
                url: '{{route('admin.companies.store')}}',
                type: 'POST',
                data:{
                    _token: '{{csrf_token()}}',
                    company_name: company_name,
                    company_image: company_image,
                    linkedin_vanity: linkedin_vanity,
                    company_slogan: company_slogan,
                    company_website: company_website,
                    company_type: company_type,
                    company_establish: company_establish,
                    company_size: company_size,
                    about: about,
                    pic_contact: pic_contact,
                    pic_email: pic_email,
                    sub_industry: sub_industry,
                    address1: address,
                    postal: postal,
                    city: city,
                    state: state,
                    country: country,
                    revenue: revenue,
                    operating_profit: operating_profit,
                    net_profit: net_profit,
                    total_assets: total_assets,
                    current_market_capital: current_market_capital,
                    capital: capital,
                    specialties_keywords: specialties_keyword,
                    other_keyword: other_keyword,
                },
                success: function (data) {
                    _Swal.close();
                    _Swal.success('Company registered successfully');
                    setTimeout(function () {
                        window.location.href = '{{route('admin.companies.index')}}';
                    }, 1000);
                }
            });
        }

        const isValidLinkedInCompanyUrl = url => /^https:\/\/www\.linkedin\.com\/company\/[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*$/.test(url);
        function prefillLinkedIn() {
            let url = $('#linked-url').val();
            if (!isValidLinkedInCompanyUrl(url)) {
                _Swal.error('Please enter a valid LinkedIn URL');
                return;
            }
            $('#modal-linkedin-prefill').modal('hide');
            _Swal.loading('Loading...', 'Getting company data from LinkedIn...');
            $.ajax({
                url: '{{route('admin.companies.prefill')}}',
                type: 'POST',
                data:{
                    _token: '{{csrf_token()}}',
                    vanity: url.match(/\/company\/([^\/]+)/)?.[1]
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    _Swal.close();
                    _Swal.success('Company data fetched successfully', 'You can now edit the data', function () {
                        $('#about').html(data.about_us);
                        $('#company_establish').val(data.founded);
                        $('#company_name').val(data.company_name);
                        $('#company_website').val((data.website).match(/https?:\/\/[^\s]+/)?.[0]);
                        var option = $('#company_type').find('option:contains(' + data.type + ')');
                        option.length ? $('#company_type').val(option.val()).trigger('change') : console.error('Option with text "' + data.type + '" not found.');
                        $('#company_size').val(data.company_size);
                        $('#company_image').attr('src', data.image_url);
                        $('#company_slogan').val(data.slogan);
                        let regionNames = new Intl.DisplayNames(['en'], {type: 'region'});
                        let locations = data.locations[0];
                        $('#country').val(regionNames.of(data.country_code.toUpperCase()));
                        $('#city').val(locations.address.split(',')[0]);
                        $('#state').val(locations.address_2 === null ? '' : locations.address_2.split(',')[1]);
                        $('#industry_classification').val(data.categories[0]).trigger('change');
                        $('#linkedin_url').val(url);
                        $('#specialties_keyword').data('tagify').removeAllTags();
                        $('#specialties_keyword').data('tagify').addTags(data.specialties);
                    });
                }
            });
        }

        function changeImage(){
            Swal.fire({
                title: 'Change Company Image',
                input: 'file',
                inputAttributes: {
                    accept: 'image/*',
                    'aria-label': 'Upload your company image'
                }
            }).then((file) => {
                if (file.value) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        $('#company_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file.value);
                }
            });
        }
    </script>
@endpush
