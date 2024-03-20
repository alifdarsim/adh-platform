<div class="nk-content-body">
    <div class="nk-chat">
        <div class="nk-chat-body !tw-pe-0">
            <div class="nk-chat-head">
                <ul class="nk-chat-head-info">
                    <li class="nk-chat-body-close">
                        <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ms-n1"><em class="icon ni ni-arrow-left"></em></a>
                    </li>
                    <li class="nk-chat-head-user">
                        <div class="user-card">
                            <div class="user-info">
                                <div class="lead-text fs-5">{{$project->name}}</div>
                                <div class="sub-text">
                                    <span class="d-none d-sm-inline me-1">Participant: </span>
{{--                                    <span class="d-none d-sm-inline me-1">{{auth()->user()->name}}</span>(ADH Member),--}}
                                    <span class="d-none d-sm-inline">You</span>,
                                    <span class="d-none d-sm-inline me-1 ms-1">{{$project->awardedTo->name ?? ''}}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="nk-chat-head-search">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-search"></em>
                            </div>
                            <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                        </div>
                    </div>
                </div><!-- .nk-chat-head-search -->
            </div><!-- .nk-chat-head -->
            <div class="nk-chat-panel" data-simplebar>
            </div>
            <div class="nk-chat-editor">
                <div class="nk-chat-editor-upload  ms-n1">
                    <div class="drodown">
                        <button type="button" class="btn btn-sm btn-icon btn-trigger text-primary btn-emoji"  data-bs-toggle="dropdown"><em class="icon ni ni-happyf-fill"></em></button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <emoji-picker></emoji-picker>
                        </div>
                    </div>
                </div>
                <div class="nk-chat-editor-form">
                    <div class="form-control-wrap">
                        <textarea class="form-control form-control-simple no-resize" rows="1" id="chat-textarea" placeholder="Type your message..."></textarea>
                    </div>
                </div>
                <ul class="nk-chat-editor-tools g-2">
                    <li>
                        <button onclick="sendMessage()" class="btn btn-round btn-primary btn-icon"><em class="icon ni ni-send-alt"></em></button>
                    </li>
                </ul>
            </div><!-- .nk-chat-editor -->
        </div><!-- .nk-chat-body -->
    </div><!-- .nk-chat -->

</div>

@push('scripts')
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
    <script>
        function uuidv4() {
            return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
        }

        // $('#chatLink').on('shown.bs.tab', function (e) {
        //     getMessage();
        // });

        document.querySelector('emoji-picker').addEventListener('emoji-click', event => {
            // console.log(event.detail)
            document.getElementById('chat-textarea').value += event.detail.emoji.unicode;
        });

       $(document).ready(function () {
           getMessage();
        });

        function getMessage(){
            $.ajax({
                url: "{{ route('expert.chat.get', $project->pid) }}",
                method: 'GET',
                success: function (response) {
                    let messages = response.messages;
                    let date = '';
                    messages.forEach(function (message) {
                        let text = message.message;
                        let id = message.id;
                        let datetime = message.created_at;
                        let isme = message.isMine;
                        addMessage(text, isme, id, datetime, false);
                    });
                    scrollToBottom();
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        function sendMessage(){
            // scrollToBottom();
            let message = $('#chat-textarea').val();
            let uuid = uuidv4();
            addMessage(message, true, uuid, new Date(), true);
            if(message.length > 0){
                $.ajax({
                    url: "{{ route('expert.chat.send', $project->pid) }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        pid: '{{ $project->pid }}',
                        message: message,
                        uuid: uuid
                    },
                    success: function (response) {
                        $('#chat-textarea').val('');
                        $('#chat-textarea').focus();
                        let uuid = response.message.uuid;
                        let timestamp = response.message.time;
                        let chat = $('#' + uuid);
                        chat.attr('id', response.message.id);
                        let sending = chat.parent().parent().find('.sending_tag');
                        sending.find('.ni-clock').removeClass('ni-clock').addClass('ni-check');
                        sending.find('span').html(dayjs(timestamp).format('hh:mm A'));
                        scrollToBottom();
                    },
                    error: function (response) {
                        console.log(response);
                    }
                })
            }
        }

        // if user press enter key then send message, if press shift+enter then new line
        $('#chat-textarea').keypress(function (e) {
            if(e.which == 13 && !e.shiftKey){
                e.preventDefault();
                sendMessage();
            }
        });

        function scrollToBottom(){
            let scroll = document.getElementsByClassName('simplebar-content-wrapper')[0];
            scroll.scrollTop = scroll.scrollHeight;
        }

        function addSap(date) {
            let html = `<div class="chat-sap">
                    <div class="chat-sap-meta"><span>${date}</span></div>
                </div>`;
            $('.nk-chat-panel').find('.simplebar-content').append(html);
        }

        function addMessage(message, isMe, uuid, datetime, isSending) {
            let bubble =
                `<div class="chat-bubble py-0" id="${uuid}">
                    <div class="chat-msg py-1  fs-13px"> ${message.replace(/\n/g, "<br>")} </div>
                    <ul class="chat-msg-more">
                        <li>
                            <div class="dropdown">
                                <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-sm">
                                    <ul class="link-list-opt no-bdr">
                                        <li class="d-sm-none"><a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a></li>
                                        <li><a href="#"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                        <li><a href="#"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>`;

            // get the last message element and check if it dateTime prop is same as the new message
            let prevMessage = $('.nk-chat-panel').find('.chat-content').last();
            if(prevMessage.prop('dateTime') !== undefined){
                let lastMessageDateTime = prevMessage.prop('dateTime');
                let lastMessageDate = lastMessageDateTime.toDateString();
                let newMessageDateTime = new Date(datetime);
                let newMessageDate = newMessageDateTime.toDateString();
                if(lastMessageDate === newMessageDate){
                    let lastMessageTime = lastMessageDateTime.getTime();
                    let newMessageTime = newMessageDateTime.getTime();
                    if(newMessageTime - lastMessageTime < 60000){
                        prevMessage.find('.chat-bubbles').append(bubble);
                        let sending = prevMessage.find('.sending_tag');
                        sending.find('.icon').removeClass('ni-check').addClass(isSending ? 'ni-clock' : 'ni-check');
                        sending.find('span').html(isSending ? 'Sending..' : dayjs(datetime).format('hh:mm A'));
                        return;
                    }
                }
                else{
                    addSap(dayjs(datetime).format('DD MMMM YYYY'));
                }
            }
            else{
                addSap(dayjs(datetime).format('DD MMMM YYYY'));
            }

            // if the message is not sent yet then add sending tag
            let timeTag = `<li><span>Sending</span><em class="icon ni ni-clock"></em></li>`
            if (!isSending) timeTag = `<li><span>${dayjs(datetime).format('hh:mm A')}</span><em class="icon ni ni-check"></em></li>`
            let html = `<div class="chat pt-0 ${isMe ? 'is-me' : 'is-you'}">
                    <div class="chat-content">
                        <div class="chat-bubbles">
                            ${bubble}
                        </div>
                        <ul class="chat-meta sending_tag">
                            ${timeTag}
                        </ul>
                    </div>
                </div>`;


            // Create a DateTime object
            const dateTimeObject = new Date(datetime);
            // Attach the DateTime object as a property to the HTML elements
            const $htmlElements = $(html);
            $htmlElements.find('.chat-content').prop('dateTime', dateTimeObject);
            $('.nk-chat-panel').find('.simplebar-content').append($htmlElements);
        }

    </script>
@endpush
