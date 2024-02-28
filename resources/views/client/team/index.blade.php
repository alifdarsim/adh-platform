@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Manage Your Team</h3>
                <div class="nk-block-des text-soft"><p>Manage, create and invite your team member</p></div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                       data-target="pageMenu"><em class="icon ni ni-more-v"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="{{route('client.team.create')}}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Create Team</span></a>
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
                <div class="alert alert-info py-1 px-2" style="display: none">
                    <strong>Note:</strong> Team section is optional. Only useful for those plan to have sub-team under their company.
                    <a onclick="hideNote()" class="ms-2 btn btn-xs btn-outline-info">Hide Note</a>
                </div>
                <div id="company_section">
                    <div class="row g-3">
                        @if(auth()->user()->client->company == null)
                            <h6><span class="fs-15px">Current Company:</span> {{auth()->user()->client->company->name ?? 'No company'}}</h6>
                        @else
                            <div class="col-7">
                                <div class="form-group">
                                    <label class="form-label" for="select_team">Choose your team.</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" id="select_team" name="select_team">
                                            @foreach(auth()->user()->client->company->teams as $team)
                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="form-label" for="company">.</label>
                                    <div class="form-control-wrap">
                                        <a onclick="manageTeam()" class="btn btn-primary">Manage This Team</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered mt-2">
            <div class="card-inner">
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

        if (localStorage.getItem('hideNote')) {
            $('.alert').css('display', 'none')
        }
        else{
            $('.alert').css('display', 'block')
        }

        function hideNote(){
            // mark at localstorage that the user has seen the note
            $('.alert').css('display', 'none')
            localStorage.setItem('hideNote', true);
        }

        function manageTeam() {
            let team_id = $('#select_team').val();
            console.log(team_id)
        }
    </script>
@endpush
