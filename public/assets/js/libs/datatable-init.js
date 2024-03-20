let table;
var stopAjaxing = true;

const datatableInit = (datatable_element, object, tableInstance = null) => {

    let ajax = object.ajax;
    let columns = object.columns;
    let data = object.data;
    let columnDefs = object.columnDefs;
    let order = object.order;
    let simpleTable = object.simpleTable;
    let external_dom = object.dom;
    let pageLength = object.pageLength;
    let tableIsExpert = object.tableIsExpert;

    $(function () {
        let has_export = true;
        let btn = has_export ? '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>' : '',
            btn_cls = has_export ? ' with-export' : '';
        let dom = '<"row justify-between g-2' + btn_cls + '"<"col-7 col-sm-4 text-start"><"col-5 col-sm-8 text-end"<"datatable-filter"<"d-flex justify-content-end g-2"' + btn + '>>>><"datatable-wrap mb-3"t><"row align-items-center px-4 pb-3"<"col-7 col-sm-12 col-md-7"p><"col-5 col-sm-12 col-md-5 text-start text-md-end"i>>';
        if (external_dom !== undefined) dom = external_dom;
        // Setup - add a text input to each footer cell
        if (!simpleTable) {
            $(`${datatable_element} thead tr`)
                .clone(true)
                .addClass('filters')
                .prependTo(`${datatable_element} thead`);
        }

        if (tableIsExpert) {
            $('#datatable_2').on('preXhr.dt', function (e, settings, data) {
                let search_empty = true;
                data = data.columns;
                current_search = data;
                for (let i = 0; i < data.length; i++) {
                    if (data[i].searchable) {
                        if (data[i].search.value !== '') {
                            search_empty = false;
                            break;
                        }
                    }
                }
                stopAjaxing = search_empty;
            })
        }

        table = $(`${datatable_element}`).DataTable({
            processing: true,
            serverSide: true,
            bdestroy: true,
            autoWidth: false,
            dom: dom,
            ajax: ajax,
            buttons: ['excel', 'pdf', 'print'],
            columns: columns,
            columnDefs: columnDefs,
            order: order,
            pageLength: pageLength === undefined ? 10 : pageLength,
            createdRow: function (row) {
                $(row).addClass('nk-tb-item');
            },
            fixedHeader: true,
            initComplete: function() {
                if (simpleTable) return;
                console.log('init complete')
                // get all data name
                this.api().columns().every( function (index) {
                    let columnName = $(this.header()).text();
                    if (columnName === '') return;
                    if (columnName === 'T. Country') columnName = 'Target Countries';
                    let colvis = `<div class="px-3 py-1 hover:tw-bg-slate-100">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="colvis custom-control-input" id="${index}">
                                        <label class="custom-control-label" for="${index}">${columnName}</label>
                                    </div>
                                </div>`;
                    $('#colvis-holder').append(colvis);
                } );
                $('.colvis').change(function () {
                    let column = $(`${datatable_element}`).DataTable().column($(this).attr('id'));
                    column.visible(!column.visible());
                });

                let api = this.api();
                api.columns().eq(0).each(function (colIdx) {
                    // get the width of the header cell
                    let colWidth = $('.filters th').eq($(api.column(colIdx).header()).index()).width();
                    let cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                    if ($(cell).text() === '') return;
                    $(cell).html('<input class="border border-secondary-subtle text-muted tw-py-1 tw-px-2 rounded table-search-pane" type="text" style="width: '+(colWidth-1)+'px;" placeholder="Search"/>');
                    $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('change', function (e) {
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})';
                            api.column(colIdx).search(this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))') : '', this.value != '', this.value == '')
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
                            $(this).trigger('change');
                        });
                });
                let check = localStorage.getItem(window.location.pathname + '_column_search') || 'false';
                if (check === 'false') $('#column_search').prop('checked', false).change();
                else $('#column_search').prop('checked', true).change();
            },
            drawCallback: function (settings) {

                //this is for shortlisting table only
                $('.answer-cell').click(function () {
                    console.log('clicked')
                    let data = window['datatable'].row($(this).parents('tr')).data();
                    console.log(data)
                    if (data.answers === null) return;
                    let answers = data.answers.map((answer, index) => {
                        // write the answer
                        let question = $(`#q${index+1}`).val();
                        console.log(question)
                        return `
                            <div class="d-flex mt-3">
                                 <div class="tw-w-6 tw-h-6 tw-flex tw-items-center tw-justify-center tw-bg-primary tw-text-white tw-rounded-full tw-mr-2">Q${index + 1}: </div>
                                 <div class="fs-16px ms-1">${question}</div>
                            </div>
                            <div class="d-flex">
                                <div class="tw-w-6 tw-h-6 tw-flex tw-items-center tw-justify-center tw-bg-primary tw-text-white tw-rounded-full tw-mr-2">A${index + 1}: </div>
                                <input class="mt-1 form-control fs-15px ps-1 ms-1" value="${answer === null ? '-' : answer}" disabled/>
                            </div>`;

                    }).join(' ');
                    let experts = `
                        <div class="d-flex py-3 justify-center !tw-bg-slate-200 round-xl ">
                             <a class="user-card me-2" href="${data.expert.url}"  target="_blank">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex me-2"><span>${data.expert.img_url ? `<img src="${data.expert.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <div class="fs-16px text-dark">${data.expert.name}</div>
                                    <div><i class="fa-brands text-info fa-linkedin fs-6 me-1"></i>${data.expert.url.replace('https://www.linkedin.com/in/','')}</div>
                                </div>
                            </a>
                        </div>`
                    answers = `${experts} ${answers}`;
                    Swal.fire({
                        title: 'Expert Answer',
                        html: answers,
                        showCloseButton: true,
                        showConfirmButton: false,
                    })
                });

                // if (tableIsExpert)
                experts_info = settings.json.data;
            }
        });
        table.on('draw', function () {
            let tooltips = $('[data-bs-toggle="tooltip"]');
            tooltips.tooltip('dispose');
            tooltips.tooltip();
        });

        $('#searchbar').on('keyup', function () {
            $(`${datatable_element}`).DataTable().search($(this).val()).draw();
        });

        // get value from local storage if exists, if not then set to default 10
        let page = localStorage.getItem(window.location.pathname + 'pagination') || 10;
        $('.page-btn').each(function () {
            if ($(this).text() === page.toString())  $(this).addClass('active');
        });
        $('.page-btn').click(function () {
            let value = $(this).text();
            $(`${datatable_element}`).DataTable().page.len(value).draw();
            $('.page-btn').removeClass('active');
            $(this).addClass('active');
            if (value === '10') localStorage.removeItem(window.location.pathname + '_pagination');
            else localStorage.setItem(window.location.pathname + '_pagination', value);
        });

        $('.export-btn').click(function (){
            let type = $(this).attr('val');
            if (type === 'excel') {
                $(`${datatable_element}`).DataTable().button(0).trigger();
            } else if (type === 'pdf') {
                $(`${datatable_element}`).DataTable().button(1).trigger();
            }
            else if (type === 'print') {
                $(`${datatable_element}`).DataTable().button(2).trigger();
            }
            $(this).closest('.dropdown-menu').prev().dropdown('toggle');
        })

        $('#column_search').change(function () {
            let value = $(this).prop('checked');
            if (value) $('.filters').removeClass('d-none');
            else $('.filters').addClass('d-none');
            localStorage.setItem(window.location.pathname + '_column_search', value);
        })

        // $('#status').change(function () {
        //     let value = $(this).val();
        //     if (value === 'all') value = '';
        //     if (value === 'not_close') {
        //         let index =  $(`${datatable_element}`).find('thead tr th').filter(function () {
        //             return $(this).text() === 'Status';
        //         }).index();
        //         $(`${datatable_element}`).DataTable().column(index).search('^(active|pending|awarded)$', true, false).draw();
                // return;
            // }
            // let index =  $(`${datatable_element}`).find('thead tr th').filter(function () {
            //     return $(this).text() === 'Status';
            // }).index();
            // $(`${datatable_element}`).DataTable().column(index).search(value).draw();
        // })
        // $('#status').change();

        if (tableInstance !== null) window[tableInstance] = table;
    });
}
