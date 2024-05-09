@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Get Paid for Completed Project</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage your project payment for all your created projects. Only the project that is had gone through expert selection process will be appeared here.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @if($projects->isEmpty())
            <div class="card py-5 mt-3 tw-items-center tw-flex tw-justify-center">
                <img src="/images/svg/no-data.svg" alt="no-data" class="tw-w-96">
                <h4 class="tw-text-2xl tw-font-semibold tw-mt-5">No project related to Payment yet</h4>
                <p class="tw-text-gray-500 tw-mt-2">Once you completed a project, your related payment info will be appearing here.</p>
            </div>
        @else
            <div class="card card-bordered card-preview">
                <div class="card-inner position-relative card-tools-toggle py-3">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline flex-nowrap gx-3">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left form-control"><i class="fa-regular fa-magnifying-glass"></i></div>
                                    <input type="text" class="tw-w-96 form-control form-control tw-rounded !tw-ps-12 focus:tw-border focus:tw-border-blue-500" id="searchbar" placeholder="Search Project, User name">
                                </div>
                            </div>
                        </div>
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-filter-alt"></em>
                                                        </a>
                                                        <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                            <div class="dropdown-head">
                                                                <span class="sub-title dropdown-title">Filter Table</span>
                                                            </div>
                                                            <div class="dropdown-body dropdown-body-rg">
                                                                <div class="row gx-6 gy-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt" for="status">STATUS</label>
                                                                            <select class="form-select js-select2 js-select2-sm" id="status">
                                                                                <option value="all">All Status</option>
                                                                                <option value="interested">Waiting Selection</option>
                                                                                <option value="not-interested">Not Interested</option>
                                                                                <option value="pending">Pending Respond</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt">COLUMN SEARCH</label>
                                                                            <br>
                                                                            <div class="custom-control custom-switch mt-1">
                                                                                <input type="checkbox" class="custom-control-input" id="column_search">
                                                                                <label class="custom-control-label" for="column_search">Hide</label>
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
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
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
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
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
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-download-cloud"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Export As</span></li>
                                                                <li><a class="export-btn py-2 clickable" val="excel"><span><i class="fa-solid fa-file-excel fs-7 me-1"></i>Export Excel</span></a></li>
                                                                <li><a class="export-btn py-2 clickable" val="pdf"><span><i class="fa-solid fa-file-pdf fs-7 me-1"></i>Export Pdf</span></a></li>
                                                                <li><a class="export-btn py-2 clickable" val="print"><span><i class="fa-solid fa-print fs-7 me-1"></i>Print Table</span></a></li>
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
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Project Title</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Payout Amount</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Payment Status</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Payment Info</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Payment Receipt</span></th>
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
                    <h5 class="modal-title">Submit Payment Proof</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="project_id">Project Title</label>
                            <input name="project_id" id="project_id" class="form-control" placeholder="" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="amount">Total Amount</label>
                            <input name="amount" id="amount" class="form-control" placeholder="Eg: SGD50000" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="info">Payment Info</label>
                            <textarea name="info" id="info" class="form-control" required placeholder="Eg: Payment Method: Direct Transfer&#10;Bank: OCBC Bank&#10;Ref Number: 00001061;&#10;Payment Time: 25/05/2023 14:10 PM;"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="file">Payment Screenshot</label>
                            <input type="file" name="file" id="file" accept="image/png, image/gif, image/jpeg, application/pdf" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" id="submit" >Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_payment_info">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="info_info">Payment Info</label>
                            <textarea name="info_info" id="info_info" disabled class="form-control" required placeholder="Eg: Payment Method: Direct Transfer&#10;Bank: OCBC Bank&#10;Ref Number: 00001061;&#10;Payment Time: 25/05/2023 14:10 PM;"></textarea>
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
        let project_id = '';
        datatableInit('#datatable', {
            ajax: '{{route('expert.payment.index')}}',
            order:  [[2, 'desc']],
            columnDefs: [
                { "orderable": false, "targets": [0,1,2,3] },
                { "className": "nk-tb-col", "targets": "_all" },
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [
                {
                    data: 'name',
                    render: function (data, type, row) {
                        return `<a href="{{route('expert.projects.show','')}}/${row.pid}" class="mb-0 text-secondary fs-14px">${data}</a><p>Project ID: ${row.pid}</p>`;
                    }
                },
                {
                    data: 'payment',
                    render: function (data, type, row) {
                        return data.released_amount;
                    }
                },
                {
                    data: 'payment',
                    render: function (data, type, row) {
                        data = data.released_status;
                        let color = data === 'pending' ? 'danger' : 'success';
                        return `<span class="badge rounded-pill text-capitalize bg-${color} px-2">${data}</span>`;
                    }
                },
                {
                    data: 'payment',
                    render: function (data, type, row) {
                        if (data.released_info === null) return '-';
                        return `<button onclick="info('${data.released_info}')" class="btn btn-sm text-capitalize btn-outline-info px-2">Info</button>`;
                    }
                },
                {
                    data: 'payment',
                    render: function (data, type, row) {
                        if (data.released_receipt === null) return '-';
                        return `<a href="{{config('app.url')}}${data.released_receipt}" target="_blank" class="btn btn-sm text-capitalize btn-outline-info px-2">Receipt</a>`;
                    }
                }
            ]
        });

        function pay(pid, name, amount){
            project_id = pid;
            $('#project_id').val(name);
            $('#amount').val(amount);
            $('#modal_payment').modal('show');
        }

        $('#file').on('change', function () {
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

        $('#submit').on('click', function () {
            let amount = $('#amount').val();
            let info = $('#info').val();
            let file = $('#file').prop('files')[0];
            if (!amount || !info || !file) {
                Swal.fire(
                    'All Fields Required!',
                    'Please fill all the fields and upload the payment screenshot.',
                    'warning'
                )
                return;
            }
            let formData = new FormData();
            formData.append('amount', amount);
            formData.append('info', info);
            formData.append('file', file);
            formData.append('pid', project_id);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '{{route('client.payment.store')}}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    Swal.fire(
                        'Payment Submitted!',
                        'Your payment has been submitted. Please wait for the admin to verify the payment.',
                        'success'
                    ).then(function () {
                        location.reload();
                    })
                },
                error: function (data) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong.',
                        'error'
                    )
                }
            })
        })

        function info(info) {
            $('#info_info').val(info);
            $('#modal_payment_info').modal('show');
        }
    </script>
@endpush
