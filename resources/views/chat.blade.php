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
     function sendMessage() {
         const input = document.getElementById('messageInput');
         const message = input.value;

         if (!message.trim()) return;

         fetch('/send-message', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
             },
             body: JSON.stringify({ message })
         });

         input.value = '';
     }

     window.Echo.channel('chat')
         .listen('MessageSent', (e) => {
             const box = document.getElementById('chatbox');
             const p = document.createElement('p');
             p.textContent = `👤 User: ${e.message.content}`;
             box.appendChild(p);
             box.scrollTop = box.scrollHeight;
         });
 </script>
 @endpush
