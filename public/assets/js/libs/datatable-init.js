let table;
const datatableInit = (datatable_element, object, tableInstance = null) => {

    let ajax = object.ajax;
    let columns = object.columns;
    let columnDefs = object.columnDefs;
    let order = object.order;
    let simpleTable = object.simpleTable;
    let external_dom = object.dom;
    let pageLength = object.pageLength;

    $(function () {
        let has_export = true;
        let btn = has_export ? '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>' : '',
            btn_cls = has_export ? ' with-export' : '';
        let dom = '<"row justify-between g-2' + btn_cls + '"<"col-7 col-sm-4 text-start"><"col-5 col-sm-8 text-end"<"datatable-filter"<"d-flex justify-content-end g-2"' + btn + '>>>><"datatable-wrap mb-3"t><"row align-items-center px-4 pb-3"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';
        if (external_dom !== undefined) dom = external_dom;
        // Setup - add a text input to each footer cell
        if (!simpleTable) {
            $(`${datatable_element} thead tr`)
                .clone(true)
                .addClass('filters')
                .prependTo(`${datatable_element} thead`);
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
            createdRow: function (row) {
                $(row).addClass('nk-tb-item');
            },
            fixedHeader: true,
            initComplete: function() {
                if (simpleTable) return;
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
                })

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

                let check = localStorage.getItem('column_search');
                if (check === null) check = 'false';
                if (check === 'false') $('#column_search').prop('checked', false).change();
                else $('#column_search').prop('checked', true).change();
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
        let page = localStorage.getItem('page');
        if (page === null) page = 10;
        $(`${datatable_element}`).DataTable().page.len(pageLength === undefined ? page : pageLength).draw();
        $('.page-btn').each(function () {
            if ($(this).text() === page.toString())  $(this).addClass('active');
        });

        $('.page-btn').click(function () {
            let value = $(this).text();
            $(`${datatable_element}`).DataTable().page.len(value).draw();
            $('.page-btn').removeClass('active');
            $(this).addClass('active');
            localStorage.setItem('page', value);
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
            localStorage.setItem('column_search', value);
        })
        $('#status').change(function () {
            let value = $(this).val();
            if (value === 'all') value = '';
            if (value === 'not_close') {
                let index =  $(`${datatable_element}`).find('thead tr th').filter(function () {
                    return $(this).text() === 'Status';
                }).index();
                $(`${datatable_element}`).DataTable().column(index).search('^(active|pending|awarded)$', true, false).draw();
                return;
            }
            let index =  $(`${datatable_element}`).find('thead tr th').filter(function () {
                return $(this).text() === 'Status';
            }).index();
            $(`${datatable_element}`).DataTable().column(index).search(value).draw();
        })
        $('#status').change();

        if (tableInstance !== null) window[tableInstance] = table;
    });
}
