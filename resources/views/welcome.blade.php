<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>



    <div class="container mx-auto h-full">
        <div class="flex h-full shadow-lg border bg-base-100 rounded-lg">
            <!-- Sidebar -->
            <div class="w-1/3 border-r overflow-y-auto">
                <div class="p-4 bg-success text-primary-content">
                    <h2 class="text-xl font-bold">Chat List</h2>
                </div>

                @foreach ($users as $user)
                    @if ($user->id != auth()->user()->id)
                        <div class="p-2 hover:bg-base-200 cursor-pointer border-b"
                            onclick="loadChat('{{ $user->id }}', '{{ $user->name }}')"
                            id="user-{{ $user->id }}">
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded-full">
                                        <img src="https://via.placeholder.com/150" alt="User Avatar">
                                    </div>
                                </div>
                                <div>
                                    <p class="font-bold">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">Hello! How are you?</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>
            <!-- Chat Section -->
            <div class="w-2/3 flex flex-col h-full">
                <div class="p-4 bg-success text-primary-content flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="w-12 h-12 rounded-full">
                                <img src="https://via.placeholder.com/150" alt="User Avatar">
                            </div>
                        </div>
                        <p class="font-bold" id="userName"></p>
                    </div>
                    <button class="btn btn-sm btn-ghost">Options</button>
                </div>
                <div id="chat-container" class="flex-1 overflow-y-auto p-4 bg-base-200">
                    <!-- Messages -->
                    <div class="chat chat-start">
                        <div class="chat-bubble">Hi there!</div>
                    </div>
                    <div class="chat chat-end">
                        <div class="chat-bubble chat-bubble-primary">Hello! How can I help you?</div>
                    </div>
                    <div class="chat chat-start">
                        <div class="chat-bubble">I'm looking for some info.</div>
                    </div>
                </div>
                <div class="p-4 bg-base-100 flex items-center space-x-3 border-t">

                    <input type="text" id="messageInput" placeholder="Type here"
                        class="input input-bordered w-full flex-1 " />
                    <button class="btn btn-primary" id="sendButton">Send</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {



            $('#chat-container').append(`
            <div class="chat chat-start ${data.message.receiver_id != {{ auth()->user()->id }} ? 'chat-end' : 'chat-start' } ">

                <div class="chat-bubble ${data.message.receiver_id != {{ auth()->user()->id }} ? 'chat-bubble-primary' : '' } ">
                    ${data.message.message}
                </div>
            </div>
        `);

        });

        let userId = 0;

        loadChat = (id, name) => {
            userId = id;

            $('#userName').text(name);

            $.ajax({
                url: '/messages/' + userId,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    renderChats(data)

                }
            });
        }


        function renderChats(data) {
            let html = '';
            data.forEach(item => {
                html += `
            <div class="chat ${item.sender_id == {{ auth()->user()->id }} ? 'chat-end' : 'chat-start' } ">
                <div class="chat-bubble ${item.sender_id == {{ auth()->user()->id }} ? 'chat-bubble-primary' : '' }">
                    ${item.message}
                </div>
            </div>
        `;
            });
            $('#chat-container').html(html);
        }


        $('#sendButton').click(function() {

            const message = $('#messageInput').val();
            const receiver_id = userId

            $.ajax({
                url: '/messages',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message,
                    receiver_id
                },

                success: function() {
                    $('#messageInput').val('');
                }
            });

        });
    </script>


</x-app-layout>
