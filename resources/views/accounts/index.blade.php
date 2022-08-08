@extends('layouts.app')

@section('title', trans('positivity::messages.accounts.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = setting('positivity.per_page');
$accounts = \Azuriom\Plugin\Positivity\Models\Accounts::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$pagination = \Azuriom\Plugin\Positivity\Models\Accounts::on("positivity")->paginate($perPage);
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-accounts">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.accounts.list') }}</h3>
                    <div class="table-responsive">
			            @include('positivity::accounts._table')
			        </div>
			    </div>
			</div>
		</div>
    </div>
@endsection
