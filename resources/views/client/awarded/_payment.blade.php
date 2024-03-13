<h6>Confirm Project Payment Amount</h6>
{{--<p>Set a new contract for the project or use the default contract for the project</p>--}}
<div class="form-control py-2">
    <label for="payment_amount">Payment Amount</label>
    <input type="text" class="form-control" id="payment_amount" placeholder="Eg: USD 5000" value="{{$project->amount ?? ''}}">
    <button class="btn btn-primary mt-3" onclick="confirmAmount()">Confirm Amount</button>
</div>
@push('scripts')
    <script>
        function confirmAmount(){
            let payment = $('#payment_amount').val();
            console.log(payment)
            $.ajax({
                url: '{{route('admin.projects.payment', ['pid' => $project->id])}}',
                method: 'POST',
                data: {
                    payment: payment
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                datatype: 'json',
                success: response => {
                    Swal.fire('Payment Confirmed', response.message, 'success').then( () => {
                        {{--window.location.href = '{{route('admin.projects.show', ['pid' => $project->pid])}}';--}}
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        }
    </script>
@endpush
