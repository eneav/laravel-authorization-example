@if(session()->has('message'))
    @php($message = session()->get('message'))

    <div class="alert alert-{{ $message->getStatusClass() }}" role="alert">
        {{ $message->getMessage() }}
    </div>
@endif