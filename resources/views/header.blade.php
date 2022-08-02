@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

<div class="py-3">
    <?php
    $features = array("accounts", "verifications");
    if(setting("positivity.has_bans")) {
        array_push($features, "bans", "oldbans");
    }
    ?>
    @foreach($features as $name)
        @can($name . ".show")
            <a class="" href="{{ route('positivity.' . $name) }}">
                <div class="btn btn-primary">
                    {{ trans('positivity::messages.' . $name . '.list') }}
                </div>
            </a>
        @endcan
    @endforeach
</div>