@csrf
<div class="card-body">
    <div class="mb-3">
        <label class="form-label" for="dbInput">{{ trans('positivity::admin.setting.per_page') }}¹</label>
        <input type="number" class="form-control @error('per_page') is-invalid @enderror" id="dbInput"
               name="per_page"
               value="{{ setting('positivity.per_page') ?? 15 }}">

        @error('per_page')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="dbInput">{{ trans('install.database.host') }}¹</label>
            <input type="text" class="form-control @error('host') is-invalid @enderror" id="dbInput"
                   name="host"
                   value="{{ setting('positivity.host') }}">

            @error('host')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-right">
            <label class="form-label" for="dbInput">{{ trans('install.database.port') }}¹</label>
            <input type="number" class="form-control @error('port') is-invalid @enderror" id="dbInput"
                   name="port"
                   value="{{ setting('positivity.port') }}">

            @error('port')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="dbInput">{{ trans('install.database.user') }}¹</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="dbInput"
                   name="username"
                   value="{{ setting('positivity.username') }}">

            @error('username')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-right">
            <label class="form-label" for="dbInput">{{ trans('install.database.password') }}¹</label>
            <input type="text" class="form-control @error('password') is-invalid @enderror" id="dbInput"
                   name="password"
                   value="{{ setting('positivity.password') }}">

            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="dbInput">{{ trans('install.database.database') }}¹</label>
        <input type="text" class="form-control @error('database') is-invalid @enderror" id="dbInput"
               name="database"
               value="{{ setting('positivity.database') }}">

        @error('database')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <p>¹{{ trans('positivity::admin.setting.empty_to_keep') }}</p>
</div>