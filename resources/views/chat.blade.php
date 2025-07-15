 @extends('layouts.app')

 @section('title', 'Private Chat')

 @section('header')
     Private Chat
 @endsection

 @section('content')
 <div class="min-h-screen w-full flex flex-col bg-gray-100">
     <div class="px-5 py-3">
         <label for="recipientSelect" class="font-semibold">Send To:</label>
         <select id="recipientSelect" class="ml-2 px-4 py-2 border rounded">
             @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                 <option value="{{ $user->id }}">{{ $user->name }}</option>
             @endforeach
         </select>
     </div>

     <div id="chatbox" class="flex-1 overflow-y-auto px-4 py-3" style="max-height: calc(100vh - 160px);"></div>

     <div class="w-full bg-white border-t py-6 px-5 flex mt-4">
         <div class="w-full max-w-4xl mx-auto flex items-center">
             <input type="text" id="messageInput" placeholder="Type your message..."
                    class="flex-1 border rounded-lg px-5 py-4 mr-4 focus:outline-none shadow text-lg">
             <button onclick="sendMessage()"
                     class="bg-blue-600 text-white px-6 py-4 rounded-lg hover:bg-blue-700 shadow text-lg font-semibold">
                 Send
             </button>
         </div>
     </div>
 </div>
 @endsection

 @push('scripts')
 <script>
     window.Laravel = {
         userId: {{ auth()->id() }}
     };

     document.addEventListener('DOMContentLoaded', function () {
         const chatbox = document.getElementById('chatbox');
         const input = document.getElementById('messageInput');
         const recipientSelect = document.getElementById('recipientSelect');
         const currentUserId = window.Laravel.userId;

         function addMessage(senderId, senderName, content) {
             const isCurrentUser = senderId === currentUserId;
             const displayName = isCurrentUser ? 'You' : senderName;

             const wrapper = document.createElement('div');
             wrapper.className = `w-full mb-2 flex ${isCurrentUser ? 'justify-end' : 'justify-start'}`;

             const bubble = document.createElement('div');
             bubble.className = `
                 w-full max-w-xl
                 px-5 py-3
                 text-gray-800
                 rounded-xl
                 shadow
                 ${isCurrentUser ? 'bg-green-100 text-right' : 'bg-blue-100 text-left'}
             `;

             bubble.innerHTML = `
                 <div><strong>${displayName}:</strong></div>
                 <div>${content}</div>
             `;

             wrapper.appendChild(bubble);
             chatbox.appendChild(wrapper);
         }

         function scrollToBottom() {
             chatbox.scrollTop = chatbox.scrollHeight;
         }

         function loadMessages(recipientId) {
             chatbox.innerHTML = '';
             fetch(`/messages?recipient_id=${recipientId}`)
                 .then(res => res.json())
                 .then(messages => {
                     messages.forEach(msg => {
                         addMessage(msg.user.id, msg.user.name, msg.content);
                     });
                     scrollToBottom();
                 });
         }

         window.sendMessage = function () {
             const message = input.value.trim();
             const recipientId = parseInt(recipientSelect.value);
             if (!message || !recipientId) return;

             fetch('/send-message', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 body: JSON.stringify({ message, recipient_id: recipientId })
             }).catch(console.error);

             addMessage(currentUserId, 'You', message);
             scrollToBottom();
             input.value = '';
         };

         // Load initial chat
         loadMessages(recipientSelect.value);

         // Reload messages on recipient change
         recipientSelect.addEventListener('change', function () {
             loadMessages(this.value);
         });

         window.Echo.private(`chat.${currentUserId}`)
             .listen('.message.sent', function (e) {
                 const recipientId = parseInt(recipientSelect.value);

                 const isBetweenCurrentAndSelected =
                     (e.message.user.id === currentUserId && e.message.recipient_id === recipientId) ||
                     (e.message.user.id === recipientId && e.message.recipient_id === currentUserId);

                 if (isBetweenCurrentAndSelected) {
                     addMessage(e.message.user.id, e.message.user.name, e.message.content);
                     scrollToBottom();
                 }
             });
     });
 </script>
 @endpush
