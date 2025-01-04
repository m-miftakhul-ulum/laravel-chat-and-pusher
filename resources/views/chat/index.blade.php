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
                <div class="p-4 bg-primary text-primary-content">
                    <h2 class="text-xl font-bold">Chat List</h2>
                </div>
                <div class="p-2 hover:bg-base-200 cursor-pointer border-b">
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="w-12 h-12 rounded-full">
                                <img src="https://via.placeholder.com/150" alt="User Avatar">
                            </div>
                        </div>
                        <div>
                            <p class="font-bold">John Doe</p>
                            <p class="text-sm text-gray-500">Hello! How are you?</p>
                        </div>
                    </div>
                </div>
                <div class="p-2 hover:bg-base-200 cursor-pointer border-b">
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="w-12 h-12 rounded-full">
                                <img src="https://via.placeholder.com/150" alt="User Avatar">
                            </div>
                        </div>
                        <div>
                            <p class="font-bold">Jane Smith</p>
                            <p class="text-sm text-gray-500">Let's meet tomorrow.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chat Section -->
            <div class="w-2/3 flex flex-col h-full">
                <div class="p-4 bg-primary text-primary-content flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="w-12 h-12 rounded-full">
                                <img src="https://via.placeholder.com/150" alt="User Avatar">
                            </div>
                        </div>
                        <p class="font-bold">John Doe</p>
                    </div>
                    <button class="btn btn-sm btn-ghost">Options</button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 bg-base-200">
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
                    <input type="text" placeholder="Type a message..." class="input input-bordered flex-1">
                    <button class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
