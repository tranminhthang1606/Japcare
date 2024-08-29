@if (count($messages) && is_array($messages))
    @foreach ($messages as $message)
        <div class="alert alert-{{ $message['level'] }}">
            @if(isset($message['message']))
                {!! $message['message'] !!}
            @endif
            {{ session()->forget('message') }}
        </div>
    @endforeach
@endif
