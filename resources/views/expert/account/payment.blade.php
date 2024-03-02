@extends('layouts.user.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Payment Information</h3>
                <div class="nk-block-des text-soft"><p>Set up your payment information and payment methods.</p></div>
            </div>
        </div>
    </div>
    @include('expert.account.tabs')
    <div class="nk-block">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Preferred Payment Method</h5>
                <div class="nk-block-des">
                    <p>Set your preferred payment method for receiving payment from AsiaDealHub.</p>
                </div>
            </div>
        </div>
        <div class="card card-bordered">
            <div class="nk-data data-list">
                <div class="data-item" data-bs-toggle="modal" data-bs-target="#payment-edit">
                    <div class="data-col">
                        <span class="data-label">Payment Method</span>
                        <div>
                            <div class="data-value tw-capitalize text-dark fs-6">
                                {{$payment->method ?? 'Not Set'}}
                            </div>
                            @if ($payment && $payment->method)
                                <div class="data-sub">
                                    @if ($payment->method === 'bank transfer')
                                        <div>Bank Name: {{$payment->payment_info->bank_name ?? ''}}</div>
                                        <div>Account No: {{$payment->payment_info->bank_account ?? ''}}</div>
                                    @elseif ($payment->method === 'paypal')
                                        <div>Username: {{$payment->payment_info->paypal_username ?? ''}}</div>
                                        <div>Email: {{$payment->payment_info->paypal_email ?? ''}}</div>
                                    @else
                                        <div>Wise Username: {{$payment->payment_info->wise_username ?? ''}}</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment-edit" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Change Payment Method</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <label class="form-label" for="payment_method">Payment Method</label>
                            <select name="payment_method" class="form-select form-control form-control-lg js-select2" id="payment_method">
                                <option value="bank transfer">Bank Transfer</option>
                                <option value="paypal">Paypal</option>
                                <option value="wise">Wise</option>
                            </select>
                        </div>
                        <div id="transfer_section" class="mt-4">
                            <p class="mb-0">*Only available for bank in Singapore</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="bank_name">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Eg: OCBC Bank" value="{{$payment->payment_info->bank_name ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="bank_account">Bank Account Number</label>
                                        <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Eg: 1234567895" value="{{$payment->payment_info->bank_account ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="paypal_section" class="mt-4">
                            <p class="mb-0">*Only available for paypal account</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="paypal_username">Paypal Username</label>
                                        <input type="text" class="form-control" id="paypal_username" name="paypal_username" placeholder="Eg: johndoeawesome" value="{{$payment->payment_info->paypal_username ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="paypal_email">Paypal Email</label>
                                        <input type="text" class="form-control" id="paypal_email" name="paypal_email" placeholder="Eg: johndoe@gmail.com" value="{{$payment->payment_info->paypal_email ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="wise_section" class="mt-4">
                            <p class="mb-0">*Only available for wise account</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <label class="form-label mb-0" for="wise_username">Wise Email</label>
                                        <input value="{{$payment->payment_info->wise_username ?? ''}}" type="text" class="form-control" id="wise_username" name="wise_username" placeholder="Eg: johndoeawesome">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updatePayment()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function changePaymentMethod() {
            $('#payment-edit').modal('show');
        }

        function updatePayment(){
            let payment_method = $('#payment_method').val();
            let payment_info = {};
            if (payment_method === 'bank transfer'){
                payment_info.bank_name = $('#bank_name').val();
                payment_info.bank_account = $('#bank_account').val();
            } else if(payment_method === 'paypal'){
                payment_info.paypal_username = $('#paypal_username').val();
                payment_info.paypal_email = $('#paypal_email').val();
            } else {
                payment_info.wise_username = $('#wise_username').val();
            }
            $.ajax({
                url: '{{route('expert.payment.update_method')}}',
                type: 'PUT',
                data: {
                    _token: '{{csrf_token()}}',
                    method: payment_method,
                    payment_info: payment_info
                },
                success: function (response) {
                    $('#payment-edit').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Payment method updated successfully!',
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        }

        $('#payment_method').on('change', function () {
            let payment_method = $(this).val();
            if (payment_method === 'bank transfer') {
                $('#transfer_section').show();
                $('#paypal_section').hide();
                $('#wise_section').hide();
            } else if (payment_method === 'paypal') {
                $('#transfer_section').hide();
                $('#paypal_section').show();
                $('#wise_section').hide();
            } else if (payment_method === 'wise') {
                $('#transfer_section').hide();
                $('#paypal_section').hide();
                $('#wise_section').show();
            }
        });

        //set default payment method
        let payment_method = '{{$payment->method ?? 'bank transfer'}}';
        //change the value of the select
        $('#payment_method').val(payment_method).trigger('change');
    </script>
@endpush

