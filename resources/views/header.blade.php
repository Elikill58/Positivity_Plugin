@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

<div class="py-3">
    @foreach(array("accounts", "verifications") as $name)
        <a class="" href="{{ route('positivity.' . $name) }}">
            <div class="btn btn-primary">
                {{ trans('positivity::messages.' . $name . '.list') }}
            </div>
        </a>
    @endforeach
</div>