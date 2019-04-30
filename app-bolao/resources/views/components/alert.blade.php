@if ($msg)
    @php
        if ($status == "error") {
            $status = "danger";
        } else if ($status == 'notification') {
            $status = "info";
        } else {
            $status = "success";
        }
    @endphp

    <div class="alert alert-{{ $status }}" role="alert">
        {{ $msg }}    
    </div>
@endif
