@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Assessment Test</h3>
                <div class="nk-block-des text-soft"><p>Prove your qualification & credibility here</p></div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group tw-flex tw-justify-center">
                            <div class="card-title"><h5 class="title">Become An Expert and Unlock Your Potential! 🎉</h5>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-4" id="question_holder">
                        <div id="introduction">
                            <div class="nk-block-content-head"><h6>Welcome to the Expert Assessment Section!</h6>
                                <p class="text-soft">Congratulations on successfully onboarding to our platform!  Now, it's time to unlock the full potential of your expertise through our Expert Assessment.</p>
                            </div>
                            <div class="nk-block-content-head"><h6>Why Take the Assessment?</h6>
                                <p class="text-soft">The Expert Assessment is designed to ensure that our platform is populated with highly skilled and verified experts like yourself. By taking this test, you contribute to the quality and credibility of our community. It's not just about passing a test; it's about showcasing your expertise and setting yourself apart.</p>
                            </div>
                            <div class="nk-block-content-head"><h6>How Does It Work?</h6>
                                <p class="text-soft">The Expert Assessment is a timed test that consists of {{$questions}} multiple-choice questions. You will have 24 hour to complete the test. If you do not pass the test, you will be able to retake it after 24 hours.</p>
                            </div>
                            <div class="text-center pt-3">
                                @if($active != 'true')
                                    <a onclick="start()" class="btn btn-primary !tw-px-20 clickable">Start Assessment</a>
                                @endif
                            </div>
                        </div>
                        <div class="question tw-hidden" id="question">
                            <div class="nk-block-content-head">
                                <div class="tw-flex justify-between">
                                    <h6 class="pt-2">Question <span id="question_num">1</span> of {{$questions}}</h6>
                                    <div class="fs-6 tw-bg-red-400 tw-w-40 py-1 tw-rounded-full text-white text-center"
                                         id="timer"></div>
                                </div>
                                <p class="fs-5 mt-4" id="questions_placeholder"></p>
                                <div class="g-4">
                                    <div class="answer_placeholder d-flex tw-flex-col tw-gap-y-5">
                                        <div class="custom-control custom-control custom-radio answer1">
                                            <input type="radio" class="custom-control-input" name="radioSize"
                                                   id="customRadio1" value="">
                                            <label class="custom-control-label" for="customRadio1"></label>
                                        </div>
                                        <div class="custom-control custom-control custom-radio answer2">
                                            <input type="radio" class="custom-control-input" name="radioSize"
                                                   id="customRadio2" value="">
                                            <label class="custom-control-label" for="customRadio2"></label>
                                        </div>
                                        <div class="custom-control custom-control custom-radio answer3">
                                            <input type="radio" class="custom-control-input" name="radioSize"
                                                   id="customRadio3" value="">
                                            <label class="custom-control-label" for="customRadio3"></label>
                                        </div>
                                        <div class="custom-control custom-control custom-radio answer4">
                                            <input type="radio" class="custom-control-input" name="radioSize"
                                                   id="customRadio4" value="">
                                            <label class="custom-control-label" for="customRadio4"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <a onclick="submitBtn()" class="btn btn-primary tw-px-20 clickable">Submit</a>
                                </div>
                                <div class="correct_answer mt-3 tw-hidden">
                                    <p><span class="tw-text-red-500" id="user_correct">You are correct!</span> The
                                        answer is '<span class="answer_value"></span>'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function start() {
            Swal.fire({
                title: 'Are you ready?',
                html: `You will have 24 hour to complete all the assessment. If you do not complete it within time limit, you need to retake the assessment from the beginning.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, start the assessment!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Good luck!',
                        html: 'Your time start now!',
                        timer: 1000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        confirmButtonText: 'Start',
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    }).then(() => {
                        startQuestion();
                    })
                }
            });

        }

        function startTimer(duration, display) {
            let timer = duration, hours, minutes, seconds;
            display.textContent = 'Time Left: --:--:--';
            let interval = setInterval(function () {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                display.textContent = 'Time Left: ' +
                    hours.toString().padStart(2, '0') + ":" +
                    minutes.toString().padStart(2, '0') + ":" +
                    seconds.toString().padStart(2, '0');

                if (--timer < 0) {
                    clearInterval(interval);
                    display.textContent = 'Time Left: 00:00:00';
                    checkAnswer({{$questions}}, '', true); // Ensure this line aligns with your implementation details
                }
            }, 1000);
        }

        function startQuestion() {
            // show the first question

            let leftDuration = 24 * 60 * 60;
            @if($assessment != null)
                let timeStart = '{{ $assessment->start_at }}';
                console.log(timeStart);
                let timeNow = '{{ now() }}';
                console.log(timeNow);
                let duration = 24 * 60 * 60 * 1000;
                let endTime = new Date(new Date(timeStart).getTime() + duration);
                let currentTime = new Date(timeNow);
                leftDuration = endTime - currentTime;
                leftDuration = Math.floor(leftDuration / 1000);
            @endif

            startTimer(leftDuration, document.querySelector('#timer'));
            document.getElementById("introduction").classList.add("tw-hidden");
            document.getElementById("question").classList.remove("tw-hidden");
            getQuestion({{$latest_question}});
        }

        function checkAnswer(question, answer, final = false) {
            // get the selected answer value
            $.ajax({
                url: "{{ route('assessment.check') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "question": question,
                    "answer": answer
                },
                dataType: "JSON",
                success: function (data) {
                    let html = `<div>
                        <div class="mt-2 d-flex">
                              <p class="text-start me-1">Q: </p>
                              <p class="text-start">${$('#questions_placeholder').text()}</p>
                        </div>
                         <div class="mt-2 d-flex">
                              <p class="text-start fs-16px me-1">A: </p>
                              <p class="text-start fs-16px">${answer}</p>
                        </div>`;
                    Swal.fire({
                        title: 'Correct!',
                        html: html,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Next Question'
                    }).then((result) => {
                        if (data.next === 'complete') {
                            Swal.fire({
                                title: 'Congratulations!',
                                html: 'You have completed the assessment.',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Finish'
                            }).then(() => {
                                window.location.href = "{{route('expert.assessment')}}";
                            });
                        } else {
                            getQuestion(data.next);
                        }
                    });
                },
                error: function (data) {
                    if (final) {
                        Swal.fire({
                            title: 'Time is up!',
                            html: 'Assessment test has ended',
                            icon: 'info',
                            showCancelButton: false,
                            confirmButtonText: 'View My Score'
                        }).then((result) => {
                            window.location.href = "{{route('expert.assessment')}}";
                        });
                    }
                    else {
                        let html = `<div>
                        <div class="mt-2 d-flex">
                              <p class="text-start me-1">Q: </p>
                              <p class="text-start">${$('#questions_placeholder').text()}</p>
                        </div>
                         <div class="mt-2 d-flex">
                              <p class="text-start fs-15px me-1">A: </p>
                              <p class="text-start fs-15px">${data.responseJSON.message}</p>
                        </div>`;
                        Swal.fire({
                            title: 'Wrong!',
                            html: html,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Next Question'
                        }).then((result) => {
                            if (data.responseJSON.next === 'complete') {
                                Swal.fire({
                                    title: 'Congratulations!',
                                    html: 'You have completed the assessment.',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'View My Score'
                                }).then((result) => {
                                    window.location.href = "{{route('expert.assessment')}}";
                                });
                            } else {
                                getQuestion(data.responseJSON.next);
                            }
                        });
                    }
                }
            });
        }

        function getQuestion(question) {
            $('#question_num').text(question);
            $.ajax({
                url: "{{ route('assessment.question') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "question": question
                },
                dataType: "JSON",
                success: function (data) {
                    $('.correct_answer').addClass('tw-hidden');
                    $('input[name="radioSize"]').prop('checked', false);
                    let question = data.question;
                    let options = data.options;
                    $('.answer1').find('label').text(options[0]);
                    $('.answer1').find('input').val(options[0]);
                    $('.answer2').find('label').text(options[1]);
                    $('.answer2').find('input').val(options[1]);
                    $('.answer3').find('label').text(options[2]);
                    $('.answer3').find('input').val(options[2]);
                    $('.answer4').find('label').text(options[3]);
                    $('.answer4').find('input').val(options[3]);

                    // fill the question
                    document.getElementById("questions_placeholder").innerHTML = question;
                }
            });
        }

        function submitBtn() {
            // get the selected answer value
            let question = document.getElementById("question_num").innerHTML;
            var selected = document.querySelector('input[name="radioSize"]:checked').value;
            checkAnswer(question, selected);
        }

        let assessment_active = '{{ $active }}';
        if (assessment_active === 'true') {

            Swal.fire({
                title: 'Continue Assessment?',
                html: 'You have an assessment pending. Please complete it to make sure that you eligible to accepting project.',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Continue Assessment'
            }).then((result) => {
                if (result.isConfirmed) {
                    startQuestion();
                }
            });
        }
    </script>
@endpush
