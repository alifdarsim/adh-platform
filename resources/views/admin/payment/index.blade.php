@extends('layouts.admin.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Project Payment</h3>
                <div class="nk-block-des text-soft">
                    <p>Verify and confirm the payment transaction is successful. You can also view the payment status and
                        info.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @if ($projects->isEmpty())
            <div class="card py-5 mt-3 tw-items-center tw-flex tw-justify-center">
                <img src="/images/svg/no-data.svg" alt="no-data" class="tw-w-96">
                <h4 class="tw-text-2xl tw-font-semibold tw-mt-5">No project related to payment appear yet</h4>
            </div>
        @else
            <div class="card card-bordered card-preview">
                <div class="card-inner position-relative card-tools-toggle py-3">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline flex-nowrap gx-3">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left form-control"><i
                                            class="fa-regular fa-magnifying-glass"></i></div>
                                    <input type="text"
                                        class="tw-w-96 form-control form-control tw-rounded !tw-ps-12 focus:tw-border focus:tw-border-blue-500"
                                        id="searchbar" placeholder="Search Project, User name">
                                </div>
                            </div>
                        </div>
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle"
                                            data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle"
                                                        data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-filter-alt"></em>
                                                        </a>
                                                        <div
                                                            class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                            <div class="dropdown-head">
                                                                <span class="sub-title dropdown-title">Filter Table</span>
                                                            </div>
                                                            <div class="dropdown-body dropdown-body-rg">
                                                                <div class="row gx-6 gy-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt"
                                                                                for="status">STATUS</label>
                                                                            <select
                                                                                class="form-select js-select2 js-select2-sm"
                                                                                id="status">
                                                                                <option value="all">All Status</option>
                                                                                <option value="interested">Waiting Selection
                                                                                </option>
                                                                                <option value="not-interested">Not
                                                                                    Interested</option>
                                                                                <option value="pending">Pending Respond
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="overline-title overline-title-alt">COLUMN
                                                                                SEARCH</label>
                                                                            <br>
                                                                            <div class="custom-control custom-switch mt-1">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    id="column_search">
                                                                                <label class="custom-control-label"
                                                                                    for="column_search">Hide</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-eye"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Show/Hide Column</span></li>
                                                                <div id="colvis-holder">
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-setting"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Row Per Page</span></li>
                                                                <li><a class="page-btn py-2 clickable">10</a></li>
                                                                <li><a class="page-btn py-2 clickable">20</a></li>
                                                                <li><a class="page-btn py-2 clickable">50</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-download-cloud"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Export As</span></li>
                                                                <li><a class="export-btn py-2 clickable"
                                                                        val="excel"><span><i
                                                                                class="fa-solid fa-file-excel fs-7 me-1"></i>Export
                                                                            Excel</span></a></li>
                                                                <li><a class="export-btn py-2 clickable"
                                                                        val="pdf"><span><i
                                                                                class="fa-solid fa-file-pdf fs-7 me-1"></i>Export
                                                                            Pdf</span></a></li>
                                                                <li><a class="export-btn py-2 clickable"
                                                                        val="print"><span><i
                                                                                class="fa-solid fa-print fs-7 me-1"></i>Print
                                                                            Table</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em
                                        class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none"
                                    placeholder="Search by user or email">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Project Title</span></th>
                            <th class="nk-tb-col"><span class="sub-text">To Receive</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Detail</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Receive Status</span></th>
                            <th class="nk-tb-col"><span class="sub-text">To Release</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Release Status</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_payment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Client Payment Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="project_id">Project Title</label>
                            <input name="project_id" id="project_id" class="form-control" placeholder="" value=""
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="receipt">Payment Receipt</label>
                            <div class="form-control-wrap">
                                <a href="" id="receipt_link" target="_blank"
                                    class="btn text-capitalize btn-outline-info bg-white py-1 hover:tw-text-blue-600 px-5"><i
                                        class="fa-solid fa-receipt me-1"></i>View Receipt</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Total Amount</label>
                            <input name="amount" id="amount" class="form-control" placeholder="Eg: SGD50000"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="info">Payment Info</label>
                            <textarea name="info" id="info" class="form-control" disabled required
                                placeholder="Eg: Payment Method: Direct Transfer&#10;Bank: OCBC Bank&#10;Ref Number: 00001061;&#10;Payment Time: 25/05/2023 14:10 PM;"></textarea>
                        </div>
                        <div class="form-group d-flex justify-end">
                            <button onclick="confirmClientPayment()" class="btn btn-primary px-5">Verify & Confirm Client
                                Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    <div class="modal fade" tabindex="-1" role="dialog" id="modal_release"> --}}
    {{--        <div class="modal-dialog modal-lg" role="document"> --}}
    {{--            <div class="modal-content"> --}}
    {{--                <div class="modal-header"> --}}
    {{--                    <h5 class="modal-title">Submit Payment Proof</h5> --}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
    {{--                </div> --}}
    {{--                <div class="modal-body"> --}}
    {{--                    <div> --}}
    {{--                        <div class="form-group"> --}}
    {{--                            <label for="project_id">Project Title</label> --}}
    {{--                            <input name="project_id" id="project_id" class="form-control" placeholder="" value="" disabled> --}}
    {{--                        </div> --}}
    {{--                        <div class="form-group"> --}}
    {{--                            <label for="amount">Total Amount</label> --}}
    {{--                            <input name="amount" id="amount" class="form-control" placeholder="Eg: SGD50000" disabled> --}}
    {{--                        </div> --}}
    {{--                        <div class="form-group mt-3"> --}}
    {{--                            <label for="info">Payment Info</label> --}}
    {{--                            <textarea name="info" id="info" class="form-control" required placeholder="Eg: Payment Method: Direct Transfer&#10;Bank: OCBC Bank&#10;Ref Number: 00001061;&#10;Payment Time: 25/05/2023 14:10 PM;"></textarea> --}}
    {{--                        </div> --}}
    {{--                        <div class="form-group mt-3"> --}}
    {{--                            <label for="file">Payment Screenshot</label> --}}
    {{--                            <input type="file" name="file" id="file" accept="image/png, image/gif, image/jpeg, application/pdf" class="form-control" required> --}}
    {{--                        </div> --}}
    {{--                        <div class="form-group mt-3"> --}}
    {{--                            <button type="submit" class="btn btn-primary" id="submit" >Update</button> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_release">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Expert Payment Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="project_name">Project Title</label>
                            <input name="project_name" id="project_name" class="form-control" placeholder=""
                                value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="receipt">Payment Receipt</label>
                            <div class="form-control-wrap">
                                <a href="" id="release_receipt_link" target="_blank"
                                    class="btn text-capitalize btn-outline-info bg-white py-1 hover:tw-text-blue-600 px-5"><i
                                        class="fa-solid fa-receipt me-1"></i>View Receipt</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="release_amount">Total Amount</label>
                            <input name="release_amount" id="release_amount" class="form-control"
                                placeholder="Eg: SGD50000" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="file_release">Payment Screenshot</label>
                            <input type="file" name="file_release" id="file_release"
                                accept="image/png, image/gif, image/jpeg, application/pdf" class="form-control" required>
                        </div>
                        <div class="form-group d-flex justify-end">
                            <button onclick="confirmExpertRelease()" class="btn btn-primary px-5">Mark as Release
                                Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>

    <script>
        let confirmPid;
        let received_info;
        datatableInit('#datatable', {
            ajax: '{{ route('admin.payment.datatable') }}',
            columnDefs: [{
                    "orderable": false,
                    "targets": [0, 1, 2, 3]
                },
                {
                    "className": "nk-tb-col",
                    "targets": "_all"
                },
                {
                    "className": "clickable",
                    "targets": [0],
                    "createdCell": function(td, cellData, rowData) {
                        $(td).on('click', () => window.location.href =
                            '{{ route('admin.projects.show', '') }}/' + rowData.pid)
                    }
                },
                {
                    "targets": [1],
                    "width": "30%",
                }
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [{
                    data: 'status',
                    render: function(data) {
                        let color = data === 'pending' ? 'danger' : (data === 'shortlisted' ? 'info' : (
                            data === 'awarded' ? 'success' : 'secondary'));
                        return `<span class="me-1 badge rounded-pill text-capitalize bg-${color} center">${data === 'active' ? 'Shortlisting' : data}</span>`;
                    }
                },
                {
                    data: 'name'
                },

                {
                    data: 'payment',
                    className: 'tw-border-l tw-border-slate-300',
                    render: function(data, type, row) {
                        console.log(data)
                        return data.received_amount;
                    }
                },
                {
                    data: 'payment',
                    render: function(data, type, row) {
                        received_info = data.received_info;
                        return `<button onclick="view('${row.name}','${data.received_amount}','', '{{ config('app.url') }}${data.received_receipt}', '${row.pid}')" class="btn btn-xs text-capitalize btn-info py-1"><i class="fa-solid fa-eye"></i></button>`;
                    }
                },
                {
                    data: 'payment',
                    className: 'tw-border-r tw-border-slate-300',
                    render: function(data, type, row) {
                        data = data.received_status;
                        let color = data === 'pending' ? 'danger' : (data === 'pending_verification' ?
                            'warning' : 'success');
                        return `<span class="badge rounded-pill text-capitalize bg-${color} px-2">${data === 'pending_verification' ? 'Verify Needed' : data}</span>`;
                    }
                },
                {
                    data: 'payment',
                    render: function(data, type, row) {
                        return data.released_amount;
                    }
                },
                {
                    data: 'payment',
                    render: function(data, type, row) {
                        data = data.released_status;
                        let color = data === 'pending' ? 'danger' : 'success';
                        return `<span class="badge rounded-pill text-capitalize bg-${color} px-2">${data}</span>`;
                    }
                },
                {
                    data: 'payment',
                    render: function(data, type, row) {
                        console.log(data)
                        let info = data.released_info;
                        let link = `{{ config('app.url') }}${data.released_receipt}`;
                        if (data.released_receipt === null) link = null;
                        return `<button onclick="viewRelease('${row.name}','${data.released_amount}','${info}', '${link}', '${row.pid}')" class="btn btn-xs text-capitalize btn-info py-1"><i class="fa-solid fa-eye"></i></button>`;
                    }
                },
            ]
        });

        function view(name, amount, info, receipt, pid) {
            console.log(pid)
            $('#modal_payment').modal('show');
            $('#project_id').val(name);
            $('#amount').val(amount);
            $('#info').val(received_info);
            $('#receipt_link').attr('href', receipt);
            confirmPid = pid;
        }

        function confirmClientPayment(pid) {
            Swal.fire({
                title: 'Confirm Client Payment?',
                text: "Please make sure the payment transaction is successful before confirming.",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.payment.confirm') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            pid: confirmPid
                        },
                        success: function(data) {
                            Swal.fire('Success!', data.message, 'success').then(function() {
                                location.reload()
                            })
                        },
                        error: function(data) {
                            Swal.fire('Error!', 'Something went wrong.', 'error')
                        }
                    })
                }
            })
        }

        function viewRelease(name, amount, info, receipt, pid) {
            $('#modal_release').modal('show');
            $('#project_name').val(name);
            $('#release_amount').val(amount);
            if (receipt === 'null') $('#release_receipt_link').addClass('disabled').attr('href', '#').text('No Receipt');
            else $('#release_receipt_link').removeClass('disabled').attr('href', receipt).text('View Receipt');
            confirmPid = pid;
        }

        $('#file_release').on('change', function() {
            let file = $(this).prop('files')[0];
            if (file.size > 2097152) {
                Swal.fire(
                    'File Too Large!',
                    'Please upload file less than 2MB.',
                    'warning'
                )
                $(this).val('');
            }
        })

        function confirmExpertRelease() {
            let file = $('#file_release').prop('files')[0];
            let formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('pid', confirmPid);
            $.ajax({
                url: '{{ route('admin.payment.release') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Payment Released', response.message, 'success').then(() => {
                        location.reload();
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        }
    </script>
@endpush
