@extends('layouts.app')

@section('title', trans('positivity::messages.acounts.list'))

@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row" id="stats">
        <div class="col-12 py-3">
            @if(app('request')->input('error') != null)
            <div class="card">
                <div class="card-body">
                    <p class="text-warning">{{ trans('positivity::messages.error.' . app('request')->input('error')) }}</p>
                </div>
            </div>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <label class="form-label" for="settingEffect">{{ trans('messages.fields.name') }}</label>
                    <input type="text" class="form-control" id="playername" name="playername" required>
                </div>
                <div class="card-footer">
                    <a type="submit" value="submit request" class="btn btn-primary" onclick="return checkValidation(document.getElementById('playername').value)">
                        {{ trans('messages.actions.continue') }}
                        <span role="status"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection