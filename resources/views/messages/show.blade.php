<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h4>Chat with {{ $receiver->name }}</h4>
    <turbo-frame id="chat-window" src="{{ route('messages.poll', $receiver->id) }}" loading="lazy" autoscroll>
    <div class="border p-3 mb-3 rounded" style="height: 400px; overflow-y: auto;">
        @foreach($messages as $message)
            @include('messages._message', ['message' => $message])
        @endforeach
    </div>
</turbo-frame>


    <form method="POST" action="{{ route('messages.store', $receiver->id) }}" data-turbo-stream>
        @csrf
        <div class="input-group">
            <input type="text" name="content" class="form-control" placeholder="Type a message..." required>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
<script>
    setInterval(() => {
        const frame = document.getElementById('chat-window');
        if (frame) {
            frame.src = frame.src;
        }
    }, 3000); 
    
    document.addEventListener('turbo:render', () => {
        const chatWindow = document.getElementById('chat-window');
        if (chatWindow) {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    });
</script>

</body>
</html> -->