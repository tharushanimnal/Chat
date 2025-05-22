@foreach (auth()->user()->unreadNotifications as $notification)
    @php $data = $notification->data; @endphp
    @if (isset($data['sender_name']))
        <div class="alert alert-info d-flex justify-content-between align-items-center rounded-3 mb-2">
            <div>
                📩 <strong>{{ $data['sender_name'] }}</strong>: {{ \Illuminate\Support\Str::limit($data['content'], 50) }}
            </div>
            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-outline-primary">View</button>
            </form>
        </div>
    @endif
@endforeach
