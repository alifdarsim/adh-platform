<div class="modal fade" tabindex="-1" id="modal-expert-list">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row gx-2">
                    <div class="col-3">
                        <div class="card card-bordered card-preview tw-h-full">
                            <div class="fs-7 text-primary px-3 py-2 clickable" id="clear_search"><em class="icon ni ni-trash"></em>Clear Search</div>
                            <div class="border border-light"></div>
                            <div class="px-3 py-2">
                                <div class="form-group mb-1">
                                    <label class="form-label mb-0" for="0">About</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter tagify" id="5" placeholder="About">
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-0" for="0">Job Role</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter tagify" id="0" placeholder="Jobs Experiences">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter tagify" id="1" placeholder="Current Role">
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 pt-0">
                                <div class="form-group">
                                    <label class="form-label mb-0" for="2">Company</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter tagify" id="2" placeholder="Search Company">
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 pt-2">
                                <div class="form-group">
                                    <label class="form-label mb-0" for="4">Skills</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter tagify" id="4" placeholder="Skill">
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 pt-2">
                                <div class="form-group mb-1">
                                    <label class="form-label mb-0" for="main_industry_classification">Industry Classification</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter" id="main_industry_classification" placeholder="Main Industry">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control column_filter" id="sub_industry_classification" placeholder="Sub Industry">
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 pt-2 pb-2">
                                <div class="form-group">
                                    <label class="form-label mb-0" for="select_countries">Target Country</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select" id="select_countries" name="select_countries" data-placeholder="Select Target Country" data-search="on" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9" id="expert_search_empty">
                        <div class="card card-bordered h-100 justify-center card-preview">
                            <div class="card py-5 mt-3 tw-items-center tw-flex tw-justify-center">
                                <img src="/images/svg/search_expert.svg" alt="no-data" class="tw-w-80">
                                <h4 class="tw-text-2xl tw-font-semibold tw-mt-5">AsiaDealHub Experts Search</h4>
                                <p class="tw-text-gray-500 tw-mt-2">Search for experts based on their job role, current role, company, skills, and industry classification.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9" id="expert_table" style="display: none">
                        <div class="card card-bordered card-preview">
                            <table id="datatable_2" class="datatable-init nk-tb-list nk-tb-ulist expert_table" data-auto-responsive="true">
                                <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Name</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Position</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Company</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Expert List</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let experts_info;
        let tagsElement;
        let current_search;
        $(document).ready(function () {
            $('#communication_language').val({!! collect($project->projectTargetInfo->communication_language)->map(fn($item) =>  $item )->implode(',') !!}).trigger('change');
            $('#target_keyword').tagify().data('tagify').addTags('{{$project->keywords->pluck('name')->implode(',  ')}}');
            tagsElement = $('.tagify').tagify();
        });

        let lastClick = 0;
        const delay = 50;
        $('.tagify').on('change', function (e) {
            if (lastClick >= (Date.now() - delay)) return;
            lastClick = Date.now();
            let value = e.target.value;
            let tagId = e.target.id;
            if (tagId === 'target_keyword') return;
            let regex = '';
            if (value.length !== 0) {
                let values = JSON.parse(value).map(item => item.value);
                regex = '(?=.*' + values.map(word => word.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')).join(')(?=.*') + ')';
            }
            window['datatable_2'].column(tagId).search(regex, true, false).draw();
        });

        $('#clear_search').click(function () {
            for (let i = 0; i < tagsElement.length; i++) {
                $(tagsElement[i]).data('tagify').removeAllTags();
            }
            tagsElement.data('tagify').removeAllTags();
            $('#select_countries').val(1).trigger('change');
            $('#main_industry_classification').val('').trigger('change');
            window['datatable_2'].columns().search('').draw();
        });

        datatableInit('#datatable_2', {
            ajax: {
                'url': '{{route('admin.experts.datatable')}}',
                'data': function (d) {
                    d.project_id = '{{$project->pid}}';
                },
                'beforeSend': function (xhr) {
                    if (stopAjaxing) {
                        $('#expert_search_empty').css('display', 'block');
                        $('#expert_table').css('display', 'none');
                        xhr.abort();
                    }
                    else{
                        $('#expert_search_empty').css('display', 'none');
                        $('#expert_table').css('display', 'block');
                    }
                }
            },
            order:  false,
            simpleTable: true,
            tableIsExpert: true,
            pageLength: 6,
            columnDefs: [
                { "className": "nk-tb-col py-2", targets: [-1], visible: true},
                { targets: '_all', visible: false}
            ],
            columns: [
                {
                    data: 'positions'
                },
                {
                    data: 'position'
                },
                {
                    data: 'companies'
                },
                {
                    data: 'company'
                },
                {
                    data: 'skill_list',
                },
                {
                    data: 'about',
                },
                {
                    data: 'country'
                },
                {
                    data: 'main_industry'
                },
                {
                    data: 'sub_industry'
                },
                {
                    data: 'name',
                    render: function (data, type, row) {
                        expert_info = row;
                        let search_value = [];
                        current_search.forEach(e => {
                            let val = e.search.value;
                            val = val.replaceAll(')(?=.*', '|');
                            val = val.replaceAll('(?=.*', '');
                            val = val.replaceAll(')', '');
                            if (val.includes('|')) {
                                val = val.split('|');
                                val.forEach(v => {
                                    if (v !== '') search_value.push(v);
                                });
                            } else {
                                if (val !== '') search_value.push(val);
                            }
                        });
                        // search value must be unique
                        search_value = [...new Set(search_value)];
                        let expert_data = {
                            name: row.name,
                            skills: row.skills,
                            about: row.about,
                            experiences: row.experiences.map(item => item.position),
                        }
                        expert_data = Object.values(expert_data).join(' ');
                        console.log(expert_data)
                        let count = search_value.map(val => {
                            let regex = new RegExp(val, 'gi');
                            return (expert_data.match(regex) || []).length;
                        }).reduce((a, b) => a + b, 0);
                        console.log(row.name)
                        console.log(count)

                        return `
                        <div class="d-flex justify-between justify-center tw-items-center">
                             <a class="user-card" href="${row.url}"  target="_blank">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>${row.img_url ? `<img src="${row.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <span class="fs-17px me-2">${data}</span><span><i class="fa-brands text-info fa-linkedin fs-6 me-1"></i>${row.url.replace('https://www.linkedin.com/in/','')}</span>
                                    <p class="mb-0"><span class="fs-13px">${row.position}</span> • <span  class="fs-13px">${row.company}</span> • <span class="fs-13px">${row.experiences[0].duration}</span></p>
                                    <p class="mb-0"><span class="fs-13px">${row.address}, ${row.country}</span></p>
                                    <p class="mb-0"><span class="fs-13px">${count} keyword(s) found</span></p>
                                </div>
                            </a>
                            <div>
                                <btn id="add_${row.id}" class="btn btn-sm btn-danger ms-1 ${row.shortlisted ? 'disabled' : ''}" onclick="addExpert(${row.id})">${row.shortlisted ? 'Added' : 'Add'}</btn>
                                <btn class="btn btn-sm btn-outline-info ms-1" onclick="expert_detail(${row.id})">Detail</btn>
                            </div>
                        </div>`
                    }
                },
            ]
        },
            'datatable_2');

        function addExpert(id){
            $(`#add_${id}`).text('Added').addClass('disabled');
            $.ajax({
                url: '{{route('admin.projects.add-expert')}}',
                type: 'POST',
                data: {
                    expert_id: id,
                    pid: '{{$project->pid}}',
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    window['datatable'].ajax.reload();

                },
                error: function (data) {
                    _Swal.error(data.responseJSON.message)
                }
            });
        }

        initCountry();
        function initCountry(){
            $.ajax({
                url: '{{route('countries.index')}}',
                dataType: 'json',
                success: function (data) {
                    $('#select_countries').select2({
                        dropdownParent: $('#modal-expert-list'),
                        data: data.map(function (item) {
                            return {
                                id: item.name,
                                text: item.emoji + ' ' + item.name + ' ',
                            }
                        }),
                        placeholder: 'Select Target Country',
                    });
                }

            });
        }

        let industry_classification;
        initIndustry();
        function initIndustry(){
            $.ajax({
                url: '{{route('industries.index')}}',
                dataType: 'json',
                success: function (data) {
                    industry_classification = data;
                    let main_industry = [...new Set(data.map(item => item.main))];
                    main_industry.unshift('❌ Clear Selection');
                    $('#main_industry_classification').select2({
                        dropdownParent: $('#modal-expert-list'),
                        data: main_industry.map(function (item) {
                            return {
                                id: item,
                                text: item,
                            }
                        }),
                        placeholder: 'Main Industry',
                    });
                }
            });
        }

        $('#main_industry_classification').on('change', function (e) {
            console.log(e.target.value)
            if (e.target.value.includes('❌')) {
                $('#main_industry_classification').val('').trigger('change');
                return;
            }
            if (e.target.value === '') {
                console.log('empty')
                window['datatable_2'].column(6).search('').draw();
                $('#sub_industry_classification').select2({placeholder: 'Sub Industry'}).empty().val('').trigger("change");
                return;
            }
            let sub_industry = industry_classification.filter(item => item.main === e.target.value).map(item => item.sub);
            $('#sub_industry_classification').select2({
                dropdownParent: $('#modal-expert-list'),
                data: sub_industry.map(function (item) {
                    return {
                        id: item,
                        text: item,
                    }
                }),
                placeholder: 'Select Sub Industry',
            });
            window['datatable_2'].column(7).search(this.value).draw();

        });

        $('#sub_industry_classification').on('change', function (e) {
            console.log(e.target.value)
            window['datatable_2'].column(8).search(e.target.value).draw();
        });

        $('#select_countries').on('change', function (e) {
            if (e.target.value === '') return;
            window['datatable_2'].column(6).search(this.value).draw();
        });


    </script>
@endpush
