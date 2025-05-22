<div class="d-flex mb-2 {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
    <div class="p-2 rounded-3 {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 75%;">
        <strong class="d-block small">{{ $message->sender->name }}</strong>
        <span>{{ $message->content }}</span>
    </div>
</div>