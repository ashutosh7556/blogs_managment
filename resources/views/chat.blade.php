 {{-- resources/views/chat.blade.php --}}
 @extends('layouts.app')

 @section('title', 'Live Chat')

 @section('header')
     Live Chatbox
 @endsection

 @section('content')
     <div style="max-width: 600px; margin: auto;">
         <div id="chatbox"
              style="border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: scroll; background: #f9f9f9; margin-bottom: 10px;">
         </div>

         <input type="text" id="messageInput" placeholder="Type your message..." class="border p-2 w-3/4">
         <button onclick="sendMessage()" class="bg-blue-500 text-white px-4 py-2">Send</button>
     </div>
 @endsection
 @push('scripts')
 <script>
     document.addEventListener('DOMContentLoaded', function () {
         const chatbox = document.getElementById('chatbox');
         const input = document.getElementById('messageInput');

         function addMessage(sender, content) {
             const p = document.createElement('p');
             p.textContent = `👤 ${sender}: ${content}`;
             chatbox.appendChild(p);
         }

         function scrollToBottom() {
             chatbox.scrollTop = chatbox.scrollHeight;
         }

         fetch('/messages')
             .then(response => response.json())
             .then(messages => {
                 messages.reverse().forEach(message => {
                     addMessage(`${message.user.name}`, message.content);
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

             addMessage('You', message);
             scrollToBottom();
             input.value = '';
         };

         // ✅ Echo listener
         if (typeof Echo !== 'undefined') {
             Echo.channel('chat')
                 .subscribed(() => {
                     console.log('📡 Subscribed to chat channel');
                 })
                 .listen('MessageSent', (e) => {
                     console.log('📨 New message received:', e);
                     addMessage(e.message.user.name, e.message.content);
                     scrollToBottom();
                 });
         } else {
             console.error('❌ Echo not initialized');
         }
     });
 </script>
 @endpush

