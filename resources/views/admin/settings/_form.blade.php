@csrf
<div class="card-body">
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="dbInput">{{ trans('install.database.host') }}¹</label>
            <input type="text" class="form-control @error('stats_host') is-invalid @enderror" id="dbInput"
                   name="stats_host"
                   value="{{ old('stats_host', $setting->stats_host ?? '') }}">

            @error('stats_host')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-right">
            <label class="form-label" for="dbInput">{{ trans('install.database.port') }}¹</label>
            <input type="number" class="form-control @error('stats_port') is-invalid @enderror" id="dbInput"
                   name="stats_port"
                   value="{{ old('stats_port', $setting->stats_port ?? '') }}">

            @error('stats_port')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="dbInput">{{ trans('install.database.user') }}¹</label>
            <input type="text" class="form-control @error('stats_username') is-invalid @enderror" id="dbInput"
                   name="stats_username"
                   value="{{ old('stats_username', $setting->stats_username ?? '') }}">

            @error('stats_username')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-right">
            <label class="form-label" for="dbInput">{{ trans('install.database.password') }}¹</label>
            <input type="text" class="form-control @error('stats_password') is-invalid @enderror" id="dbInput"
                   name="stats_password"
                   value="{{ old('stats_password', $setting->stats_password ?? '') }}">

            @error('stats_password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="dbInput">{{ trans('install.database.database') }}¹</label>
        <input type="text" class="form-control @error('stats_database') is-invalid @enderror" id="dbInput"
               name="stats_database"
               value="{{ old('stats_database', $setting->stats_database ?? '') }}">

        @error('stats_database')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <p>¹{{ trans('positivity::admin.setting.empty_to_keep') }}</p>
</div>