@push('css')
    <style>
    
    </style>
@endpush

@if ($session = Session::get('success'))
<div id="alert" style="position: fixed; bottom: 2em; right: 2em">
    <div class="box has-background-success has-text-white">
        <i class="far fa-thumbs-up"></i> <span class="ml-2">{{ $session }}</span>
    </div>
</div>
@endif

@if ($session = Session::get('error'))
<div id="alert" style="position: fixed; bottom: 2em; right: 2em">
    <div class="box has-background-danger has-text-white">
        <i class="fas fa-warning"></i> <span class="ml-2">{{ $session }}</span>
    </div>
</div>
@endif

@push('js')
    <script>
        setTimeout(() => {
            document.getElementById('alert').remove();
        }, 3000);
    </script>
@endpush

