@extends('layouts.app')

@section('title', 'Not found')

@section('content')
    @include("positivity::header")
    <div class="row">
        <div class="col-12">
            {{ trans('positivity::messages.error.not-found') }}
        </div>
    </div>
@endsection