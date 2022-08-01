@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

<div class="py-3">
    @foreach(array("accounts", "verifications", "bans", "oldbans") as $name)
        @can($name . ".show")
            <a class="" href="{{ route('positivity.' . $name) }}">
                <div class="btn btn-primary">
                    {{ trans('positivity::messages.' . $name . '.list') }}
                </div>
            </a>
        @endcan
    @endforeach
</div>