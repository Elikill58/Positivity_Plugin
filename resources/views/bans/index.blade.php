@include("positivity::_database")

@extends('layouts.app')

@section('title', trans('positivity::messages.bans.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = setting('positivity.per_page');
$bans = \Azuriom\Plugin\Positivity\Models\Bans::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$pagination = \Azuriom\Plugin\Positivity\Models\Bans::on("positivity")->paginate($perPage);
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-bans">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.bans.list') }}</h3>
                    <div class="table-responsive">
                        @include('positivity::bans._table')
			        </div>
			    </div>
			</div>
		</div>
    </div>
@endsection
