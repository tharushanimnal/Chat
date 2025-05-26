<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="5">
    <title>Monitoring - Unfiltered Messages</title>
</head>
<body>
    <h1>Unfiltered Messages Monitoring</h1>
    <div id="messages">
        @foreach($messages as $message)
            <div class="message">
                <strong>{{ $message->sender->name }}:</strong>
                {{ auth()->user()->role === 'admin' ? $message->original_content : $message->content }}
            </div>
        @endforeach

    </div>
</body>
</html>
