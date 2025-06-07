@extends('layouts.logged_in')

@section('page-tile', 'Ask HyperPlus ChatBot')

@section('content')
    <div class="col-12 col-lg-12 col-xl-12 d-flex flex-column">
        <div class="card">
            <div class="card-body scrollable" style="height: 35rem">
                <div class="chat">
                    <div class="chat-bubbles" id="chat">
                        <div class="chat-item">
                            <div class="row align-items-end">
                                <div class="col-auto"><span class="avatar">H+</span>
                                </div>
                                <div class="col col-lg-6">
                                    <div class="chat-bubble">
                                        <div class="chat-bubble-title">
                                            <div class=" chat-bubble-author">HyperPlus ChatBot</div>
                                        </div>
                                        <div class="chat-bubble-body">
                                            How can I increase your knowledge on hypertension today?
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="form-control" autocomplete="off" placeholder="Type message"
                            id="message" />
                    </div>
                    <div class="col">
                        <button class="btn btn-primary w-100" type="button" onclick="sendPrompt()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 14l11 -11" />
                                <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                            </svg>
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sendPrompt() {
            newUserMessage(document.getElementById('message').value);
            newBotMessage("Loading...");
            getResponse();
        }

        function newBotMessage(message) {
            chat_item = newElement('div', ['class-item'], '', {});
            row = newElement('row', ['row', 'align-items-end'], '', {});
            avatar = newElement('div', ['col-auto'], '', {});
            avatar_span = newElement('span', ['avatar'], 'H+', {});

            chat_col = newElement('div', ['col', 'col-lg-6'], '', {});
            chat_bubble = newElement('div', ['chat-bubble'], '', {});
            chat_bubble_title = newElement('div', ['chat-bubble-title'], '', {});

            chat_bubble_title_author = newElement('div', ['chat-bubble-author'], 'HyperPlus Chatbot', {});

            chat_bubble_body = newElement('div', ['chat-bubble-body'], nl2br(message), {});

            addChildELement(avatar, [avatar_span]);

            addChildELement(chat_bubble_title, [chat_bubble_title_author]);
            addChildELement(chat_bubble, [chat_bubble_title, chat_bubble_body]);
            addChildELement(chat_col, [chat_bubble]);
            addChildELement(row, [avatar, chat_col]);
            addChildELement(chat_item, [row]);
            addChildBasedOnId('chat', [chat_item]);
        }

        function newUserMessage(message) {
            chat_item = newElement('div', ['class-item'], '', {});
            row = newElement('row', ['row', 'align-items-end', 'justify-content-end'], '', {});
            avatar = newElement('div', ['col-auto'], '', {});
            avatar_span = newElement('span', ['avatar'], 'USER', {});

            chat_col = newElement('div', ['col', 'col-lg-6'], '', {});
            chat_bubble = newElement('div', ['chat-bubble'], '', {});
            chat_bubble_title = newElement('div', ['chat-bubble-title'], '', {});

            chat_bubble_title_author = newElement('div', ['chat-bubble-author'], 'User', {});

            chat_bubble_body = newElement('div', ['chat-bubble-body'], message, {});

            addChildELement(avatar, [avatar_span]);

            addChildELement(chat_bubble_title, [chat_bubble_title_author]);
            addChildELement(chat_bubble, [chat_bubble_title, chat_bubble_body]);
            addChildELement(chat_col, [chat_bubble]);
            addChildELement(row, [chat_col, avatar]);
            addChildELement(chat_item, [row]);
            addChildBasedOnId('chat', [chat_item]);
        }

        function nl2br(str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        function getResponse() {
            $.post({!! json_encode(url('/chatbot/prompt')) !!}, {
                _method: "POST",
                data: {
                    prompt: document.getElementById('message').value
                },
                _token: "{{ csrf_token() }}"
            }).then((end_result) => {
                // if (end_result. == 'success') {

                // } else {
                //     swal.fire(
                //         "Oops! Something went wrong.",
                //         end_result,
                //         "error");
                // }
                newBotMessage(end_result.message);
            })
        }

        function newElement(element_type, class_list, inner_html, attributes) {
            var newElement = document.createElement(element_type);

            if (inner_html != '') {
                newElement.innerHTML = inner_html;
            }

            Object.keys(attributes).forEach((element) => {
                newElement.setAttribute(element, attributes[element]);
            })

            class_list.forEach((element) => {
                newElement.classList.add(element);
            });

            return newElement;
        }

        function addChildBasedOnId(element_id, children) {
            children.forEach((element) => {
                document.getElementById(element_id).appendChild(element);
            })
        }

        function addChildELement(parentElement, children) {
            children.forEach((element) => {
                parentElement.appendChild(element);
            })
        }
    </script>
@endsection
