<turbo-stream action="append" target="chat-window">
    <template>
        @include('messages._message', ['message' => $message])
    </template>
</turbo-stream>
