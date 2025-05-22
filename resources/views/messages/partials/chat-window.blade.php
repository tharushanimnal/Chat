@foreach ($messages as $message)
    @include('messages._message', ['message' => $message])
@endforeach
