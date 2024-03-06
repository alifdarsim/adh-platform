@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Your Company</h3>
                <div class="nk-block-des text-soft"><p>Manage your company for all of your projects.</p></div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                       data-target="pageMenu"><em class="icon ni ni-more-v"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="{{route('client.company.create')}}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Create New Company</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div id="company_section">
                    <p>* If the company not registered yet, you can create new one <a class="text-info tw-underline" href="{{route('client.company.create')}}">here</a></p>

                    <div class="row g-3">
                        <div class="col-7">
                            <div class="form-group">
                                <label class="form-label" for="select_company">Search you company</label>
                                <div class="form-control-wrap">
                                    <select class="form-select"
                                            id="select_company" name="select_company"
                                            data-placeholder="Select Company"
                                            data-search="on" required>
                                        <option value="{{auth()->user()->client->company->id ?? ''}}">{{auth()->user()->client->company->name ?? ''}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label class="form-label" for="company">.</label>
                                <div class="form-control-wrap">
                                    <a onclick="updateCompany()" class="btn btn-primary">Update</a>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->client->company == null)
                            <div class="card bg-white">
                                <li class="nk-support-item">
                                    <h6><span class="fs-15px">Current Company:</span> {{auth()->user()->client->company->name ?? 'No company'}}</h6>
                                </li>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="px-0" id="company_holder">
                                    <h6 class="overline-title mb-2">Your Company Information</h6>
                                    <div class="card bg-white">
                                        <li class="nk-support-item">
                                            <div class="">
                                                <img id="company_image" class="h-100px" src="{{auth()->user()->client->company->img_url}}" alt="">
                                            </div>
                                            <div class="nk-support-content">
                                                <div class="title">
                                                    <span class="fs-5" id="company_name">{{auth()->user()->client->company->name}}</span>
                                                    <p id="company_country" class="fs-6">
                                                        {{auth()->user()->client->company->address->emoji}} {{auth()->user()->client->company->address->address}}, {{auth()->user()->client->company->address->state}}, {{auth()->user()->client->company->address->country}}
                                                    </p>
                                                </div>
                                                <p id="company_industry"></p>
                                                <p><i class="fa-regular fa-globe me-1"></i><span id="company_website">{{auth()->user()->client->company->website}}</span></p>
                                                <p><i class="fa-regular fa-calendar me-1"></i><span id="company_establish">{{auth()->user()->client->company->establish}}</span></p>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>

    </script>
    <script>
        $(document).ready(function() {
            // add new option to select2
            {{--let data = {--}}
            {{--    id: '{{auth()->user()->client->company->id ?? ''}}',--}}
            {{--    text: '{{auth()->user()->client->company->name ?? ''}}',--}}
            {{--    img: '{{auth()->user()->client->company->img_url ?? ''}}'--}}
            {{--};--}}
            {{--let newOption = new Option(data.text, data.id, false, false);--}}
            {{--// $('#select_company').select2({data: [newOption]});--}}
            {{--$('#select_company').select2({--}}
            {{--    templateResult: formatResult,--}}
            {{--    templateSelection: formatSelection,--}}
            {{--}).append(newOption).trigger('change');--}}
            {{--$('#select_company').val(data.id).trigger('change');--}}

            $('#select_company').select2({
                ajax: {
                    url: '{{route('company.search')}}',
                    dataType: 'json',
                    delay: 10,
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
                placeholder: 'No company',
                minimumInputLength: 1,
                templateResult: formatResult,
                templateSelection: formatSelection,
            });
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
            let img = result.img ? result.img : '{{auth()->user()->client->company->img_url ?? ''}}';
            return $(
                '<div class="select2-result">' +
                '<img class="select2-result__image me-1 h-1rem" src="' + img + '">' +
                '<span class="select2-result__text">' + result.text + '</span>' +
                '</div>'
            );
        }

        function updateCompany() {
            let company_id = $('#select_company').val();
            $.ajax({
                url: '{{route('company.update')}}',
                type: 'PUT',
                data: {
                    _token: '{{csrf_token()}}',
                    company_id: company_id
                },
                success: function (data) {
                    _Swal.success('Success', data.message, function () {
                        location.reload();
                    });
                },
                error: function (data) {
                    _Swal.error(data.responseJSON.message);
                }
            });
        }

    </script>
@endpush
