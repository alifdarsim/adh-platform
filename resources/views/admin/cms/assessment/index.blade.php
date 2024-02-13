@extends('layouts.admin.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Assessment Question</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage expert assessment questions</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @foreach($questions as $question)
            <div class="card card-bordered card-preview question-card" order="{{$question->order}}">
                <div class="card-inner">
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-12 mt-3">
                                <div class="form-group">
                                    <div class="tw-flex tw-justify-between tw-items-center mb-1">
                                        <label class="form-label card_num">Question {{$question->order}}</label>
{{--                                        <label class="form-label card_num">Question {{$loop->index }}</label>--}}
                                        <div>
                                            <div onclick="deleteQuestion({{$question->order}})" class="btn btn-sm tw-bg-red-500 hover:tw-bg-red-600 text-white">Delete</div>
                                            <div onclick="saveQuestion({{$question->order}})" class="btn btn-sm tw-bg-blue-500 hover:tw-bg-blue-600 text-white">Save</div>
                                        </div>
                                    </div>
                                    <div class="form-control-wrap">
                                        <textarea type="text" class="form-control" rows="1" id="first_name"
                                                  placeholder="Insert question here">{{$question->question}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                    <label class="form-label fs-12px mb-0">Correct Answer <i class="fa-solid fa-circle-check tw-text-green-500"></i></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control tw-bg-green-100" value="{{$question->options[0]}}" placeholder="Correct Answer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                    <label class="form-label fs-12px mb-0">Wrong Answer <i class="fa-solid fa-circle-xmark tw-text-red-500"></i></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control tw-bg-red-50" value="{{$question->options[1]}}" placeholder="Wrong Answer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                    <label class="form-label fs-12px mb-0">Wrong Answer <i class="fa-solid fa-circle-xmark tw-text-red-500"></i></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control tw-bg-red-50" value="{{$question->options[2]}}" placeholder="Wrong Answer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                    <label class="form-label fs-12px mb-0" for="last_name">Wrong Answer <i class="fa-solid fa-circle-xmark tw-text-red-500"></i></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control tw-bg-red-50" value="{{$question->options[3]}}" placeholder="Wrong Answer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <a onclick="addQuestionCard()" class="btn tw-bg-blue-500 hover:tw-bg-blue-600 tw-px-24 mt-4 text-white">Add Question</a>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $("textarea").each(function () {
                this.style.height = "auto";
                this.style.height = this.scrollHeight + 4 + "px";
            });
        });

        function addQuestionCard(){
            let card = $($('.question-card')[0]);
            let newCard = card.clone();
            newCard.find('textarea').val('');
            newCard.find('input').each(function () {
                $(this).val('');
            });
            let lastCardOrder = parseInt($('.question-card').last().attr('order'));
            newCard.attr('order', lastCardOrder + 1);
            newCard.find('.card_num').text(`Question ${lastCardOrder + 1}`);
            $('.nk-block').append(newCard);
            // change onclick function on save button
            newCard.find('.btn-sm').eq(1).attr('onclick', `saveQuestion(${lastCardOrder + 1})`);
            // change onclick function on delete button
            newCard.find('.btn-sm').eq(0).attr('onclick', `deleteQuestion(${lastCardOrder + 1})`);
        }

        function saveQuestion(order) {
            let question = $(`[order=${order}]`).find('textarea').val();
            let options = [];
            $(`[order=${order}]`).find('input').each(function () {
                options.push($(this).val());
            });
            console.log(options)
            $.ajax({
                url: '{{route('quiz.update')}}',
                type: 'PUT',
                data: {
                    _token: '{{csrf_token()}}',
                    order: order,
                    question: question,
                    option1: options[0],
                    option2: options[1],
                    option3: options[2],
                    option4: options[3],
                },
                success: function (response) {
                    console.log(response);
                    _Swal.success('Question saved successfully!')
                },
                error: function (response) {
                    console.log(response);
                    alert('Error saving question!');
                    _Swal.error('Error saving question!')
                }
            });
        }

        function deleteQuestion(order) {
            Swal.fire({
                title: 'Delete Question?',
                html: `You are about to delete question ${order}.<br>Confirm to proceed?`,
                icon: 'info', showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('quiz.destroy')}}',
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}',
                            order: order
                        },
                        success: function (response) {
                            console.log(response);
                            _Swal.success('Question deleted successfully!');
                            window.location.reload();
                        },
                        error: function (response) {
                            console.log(response);
                            _Swal.error('Error deleting question!')
                        }
                    });
                }
            })
        }
    </script>
@endpush
