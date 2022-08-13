@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

<div class="py-3 banner">
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
    <div class="banner-search">
        <input type="text" class="form-control" id="playername" name="playername" required>
        <a type="submit" value="submit request" class="btn btn-primary" onclick="return checkValidation(document.getElementById('playername').value)">
            {{ trans('messages.actions.search') }}
            <span role="status"></span>
        </a>
    </div>
</div>

@push('scripts')
    <script>
        function checkValidation(name) {
            window.location.href = "{{ route('positivity.accounts.show', ['account' => 'UUID']) }}".replace('UUID', name);
            return false;
        }
    </script>
@endpush