@extends('admin.layouts.admin')

@section('title', trans('positivity::admin.setting.title'))

@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('positivity.admin.setting.update', $setting) }}" method="POST">
                        <h3>{{ trans('positivity::admin.setting.title') }}</h3>
                        @method('PUT')
                        @include('positivity::admin.settings._form')
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection