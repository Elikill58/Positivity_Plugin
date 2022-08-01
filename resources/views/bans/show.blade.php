<?php
$bans = \Azuriom\Plugin\Positivity\Models\Bans::on("positivity")->where("id", "=", $uuid)->get();
if(isset($bans)) {
    $uuid = $uuid;
} else {
	?>
    @include("positivity::error.not-found");
    <?php
    exit();
}
if(count($bans) > 0) {
	$name = $bans[0]->getPlayerName();
} else {
	$account = \Azuriom\Plugin\Positivity\Models\Accounts::on("positivity")->where("id", "=", $uuid)->first();
	if(isset($account))
		$name = $account->playername;
	else
		$name = "?";
}


?>

@extends('layouts.app')

@section('title', trans('positivity::messages.bans.index', ['name' => $name]))

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-ban">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                	<div style="display: flex;">
	                    <div class="text-center" style="width: 30%;">
	                		<h3>{{ trans('positivity::messages.bans.index', ['name' => $name]) }}</h3>
	                    	<img src="https://crafatar.com/avatars/{{ $uuid }}">
	                		<a href="{{ route('positivity.accounts.show', $uuid) }}" class="btn btn-primary my-3">{{ trans('positivity::messages.accounts.see') }}</a>
	                    </div>

	                    <div class="table-responsive" style="width: 70%;">
	                    	@if(count($bans) == 0)
	                    		<p class="text-center">{{ trans('positivity::messages.bans.index_empty', ['name' => $name]) }}</p>
	                    	@else
		                        <table class="table">
			                        <thead>
						                <tr>
						                    <th scope="col">{{ trans('messages.fields.name') }}</th>
						                    <th scope="col">{{ trans('positivity::messages.bans.reason') }}</th>
						                    <th scope="col">{{ trans('positivity::messages.bans.banned_by') }}</th>
						                    <th scope="col">{{ trans('positivity::messages.bans.expiration_time') }}</th>
						                    <th scope="col">{{ trans('positivity::messages.bans.cheat') }}</th>
						                    <th scope="col">{{ trans('positivity::messages.bans.creation_time') }}</th>
						                </tr>
			                        </thead>
			                        <tbody>
				                	@foreach($bans as $ban)
					                    <tr class="sortable-dropdown tag-parent" data-ban-id="{{ $ban->id }}">
					                        <td>
							                    {{ $ban->getPlayerName() }}
					                        </td>
					                        <td>
							                    {{ $ban->reason }}
					                        </td>
					                        <td>
							                    {{ $ban->banned_by }}
					                        </td>
					                        <td>
							                    {{ $ban->getDateFromMillis() }}
					                        </td>
					                        <td>
							                    {{ $ban->cheat_name }}
					                        </td>
					                        <td>
							                    {{ $ban->execution_time }}
					                        </td>
					                    </tr>
					                @endforeach
			                        </tbody>
			                    </table>
			                @endif
					    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection