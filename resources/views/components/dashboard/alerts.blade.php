@props([
    'alerts' => ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'],
])

@foreach ($alerts as $msg)
    @if (Session::has('alert-' . $msg))
        @php
            $alert = $msg == 'success' ? 'primary' : $msg;
        @endphp
        <div class="alert alert-{{ $alert }} alert-dismissible mb-3" role="alert">
            {{ Session::get('alert-' . $msg) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach
