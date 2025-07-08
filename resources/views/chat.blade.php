 @extends('layouts.app')

 @section('title', 'Live Chat')

 @section('header')
     Live Chatbox
 @endsection

 @section('content')
 <div class="min-h-screen w-full flex flex-col bg-gray-100">
   <!-- Messages area -->
     <div id="chatbox"
          class="flex-1 overflow-y-auto px-4 py-3"
          style="max-height: calc(100vh - 100px);">
     </div>  <!-- Input bar at bottom, not fixed -->
      <div class="w-full bg-white border-t py-6 px-5 flex mt-10">
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
     document.addEventListener('DOMContentLoaded', function () {
         const chatbox = document.getElementById('chatbox');
         const input = document.getElementById('messageInput');
         const currentUserId = {{ auth()->id() }};

          function addMessage(senderId, senderName, content) {
              const isCurrentUser = senderId === currentUserId;
              const displayName = isCurrentUser ? 'You' : senderName;

              const emoji = `<span class="inline-flex items-center justify-center w-6 h-6 rounded-full ${isCurrentUser ? 'bg-green-500' : 'bg-blue-200'} text-white text-sm mr-2">👤</span>`;

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
                  <div class="flex items-center ${isCurrentUser ? 'justify-end flex-row-reverse' : ''}">
                      ${emoji}
                      <strong class="mr-1">${displayName}:</strong>
                  </div>
                  <div>${content}</div>
              `;

              wrapper.appendChild(bubble);
              chatbox.appendChild(wrapper);
          }


         function scrollToBottom() {
             chatbox.scrollTop = chatbox.scrollHeight;
         }

         fetch('/messages')
             .then(res => res.json())
             .then(messages => {
                 messages.reverse().forEach(msg => {
                     addMessage(msg.user.id, msg.user.name, msg.content);
                 });
                 scrollToBottom();
             });

         window.sendMessage = function () {
             const message = input.value.trim();
             if (!message) return;

             fetch('/send-message', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 body: JSON.stringify({ message })
             }).catch(console.error);

             addMessage(currentUserId, 'You', message);
             scrollToBottom();
             input.value = '';
         };

         if (typeof Echo !== 'undefined') {
             Echo.channel('chat')
                 .listen('MessageSent', e => {
                     if (e.message.user.id !== currentUserId) {
                         addMessage(e.message.user.id, e.message.user.name, e.message.content);
                         scrollToBottom();
                     }
                 });
         }
     });
 </script>
 @endpush
