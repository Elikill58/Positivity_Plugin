@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

<div class="row">
    @foreach(array("accounts") as $name)
        <a class="col-3 py-3" href="./{{ $name }}">
            <div class="btn btn-primary">
                {{ trans('positivity::messages.' . $name . '.list') }}
            </div>
        </a>
    @endforeach
</div>