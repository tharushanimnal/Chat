<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">

    <!-- <div id="notification-area" class="mb-3"></div> -->

    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chat with {{ $user->name }}</h5>
            <small class="text-light">Secure Messaging</small>
        </div>

        <div id="chat-window" class="card-body p-3" style="height: 400px; overflow-y: auto; background-color: #f9f9f9;">
            @foreach ($messages as $message)
                @include('messages._message', ['message' => $message])
            @endforeach
        </div>

        <div class="card-footer bg-white border-top-0">
            <form method="POST" action="{{ route('messages.store', $user->id) }}" data-turbo-stream class="d-flex align-items-start gap-2">
                @csrf
                <textarea name="content" class="form-control rounded-3" rows="2" placeholder="Type your message..." required></textarea>
                <button class="btn btn-primary px-4 rounded-3">Send</button>
            </form>
        </div>
    </div>
</div>

<script>
    function scrollChatToBottom() {
        const chatWindow = document.getElementById('chat-window');
        if (chatWindow) {
            setTimeout(() => {
                chatWindow.scrollTop = chatWindow.scrollHeight;
            }, 300);
        }
    }

    function pollChat() {
        fetch("{{ route('messages.poll', $user->id) }}")
            .then(res => res.text())
            .then(html => {
                document.getElementById("chat-window").innerHTML = html;
                scrollChatToBottom();
            });
    }

    function pollNotifications() {
        fetch("{{ url('/notifications/poll') }}")
            .then(res => res.text())
            .then(html => {
                document.getElementById("notification-area").innerHTML = html;
            });
    }

    setInterval(pollChat, 3000);
    setInterval(pollNotifications, 5000);

    document.addEventListener('DOMContentLoaded', function () {
        scrollChatToBottom();
        pollNotifications();
    });

    document.addEventListener('turbo:load', scrollChatToBottom);
    document.addEventListener('turbo:render', scrollChatToBottom);
    document.addEventListener('turbo:frame-load', scrollChatToBottom);

    document.querySelector('form')?.addEventListener('submit', function () {
        this.setAttribute('data-turbo-stream', true);
    });
</script>

</body>
</html>
