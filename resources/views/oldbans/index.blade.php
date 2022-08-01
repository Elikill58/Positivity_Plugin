@extends('layouts.app')

@section('title', trans('positivity::messages.oldbans.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = $setting->per_page;
$oldbans = \Azuriom\Plugin\Positivity\Models\OldBans::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$haveMore = count($oldbans) == $perPage;
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-oldbans">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.oldbans.list') }}</h3>
                    <div class="table-responsive">
                        @include('positivity::oldbans._table')
			        </div>
			    </div>
			</div>
			@include("positivity::pager")
		</div>
    </div>
@endsection
