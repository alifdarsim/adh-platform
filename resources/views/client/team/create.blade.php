@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Create Team</h3>
                <div class="nk-block-des text-soft"><p>Create and invite your team member</p></div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div id="company_section">
                    <div class="row g-3">
                        @if(auth()->user()->client->company == null)
                            <h6><span class="fs-15px"><i class="fa-solid fa-circle-info me-1 text-info"></i>You need to set your company first to create a team</span></h6>
                        @else
                            <div class="col-12">
                                <div class="px-0" id="company_holder">
                                    <h6 class="overline-title mb-2">Create a team under this Company</h6>
                                    <div class="card bg-white">
                                        <li class="nk-support-item">
                                            <div class="">
                                                <img id="company_image" class="tw-h-[60px]" src="{{auth()->user()->client->company->img_url}}" alt="">
                                            </div>
                                            <div class="nk-support-content">
                                                <div class="title">
                                                    <span class="fs-14px" id="company_name">{{auth()->user()->client->company->name}}</span>
                                                    <p id="company_country" class="fs-14px">
                                                        {{auth()->user()->client->company->address->emoji}} {{auth()->user()->client->company->address->address}}, {{auth()->user()->client->company->address->state}}, {{auth()->user()->client->company->address->country}}
                                                    </p>
                                                </div>
                                                <p id="company_industry"></p>
                                                <p><i class="fa-regular fa-globe me-1"></i><span id="company_website">{{auth()->user()->client->company->website}}</span></p>
{{--                                                <p><i class="fa-regular fa-calendar me-1"></i><span id="company_establish">{{auth()->user()->client->company->establish}}</span></p>--}}
                                            </div>
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-4 mt-0">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="team_name">Team Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="team_name" placeholder="Eg: Finance Team A">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <div class="form-group">
                                        <a onclick="registerClientTeam()" class="btn btn-primary tw-px-24">Register Team</a>
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
        $(document).ready(function() {

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

        function registerClientTeam(){
            let team_name = $('#team_name').val();
            $.ajax({
                url: '{{route('client.team.store')}}',
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    team_name: team_name
                },
                success: function (data) {
                    _Swal.success('Success', data.message, function () {
                        window.location.href = '{{route('client.team.index')}}';
                    });
                },
                error: function (data) {
                    _Swal.error(data.responseJSON.message);
                }
            });
        }

    </script>
@endpush
