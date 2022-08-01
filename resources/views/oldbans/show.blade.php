<?php
$oldbans = \Azuriom\Plugin\Positivity\Models\OldBans::on("positivity")->where("id", "=", $uuid)->get();
if(isset($oldbans)) {
    $uuid = $uuid;
} else {
	?>
    @include("positivity::error.not-found");
    <?php
    exit();
}
if(count($oldbans) > 0) {
	$name = $oldbans[0]->getPlayerName();
} else {
	$account = \Azuriom\Plugin\Positivity\Models\Accounts::on("positivity")->where("id", "=", $uuid)->first();
	if(isset($account))
		$name = $account->playername;
	else
		$name = "?";
}

?>

@extends('layouts.app')

@section('title', trans('positivity::messages.oldbans.index', ['name' => $name]))

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-oldban">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="text-center" style="padding-bottom: 1.5rem;">
                		<h3>{{ trans('positivity::messages.oldbans.index', ['name' => $name]) }}</h3>
                    	<img src="https://crafatar.com/avatars/{{ $uuid }}">
                    </div>

                    <div class="table-responsive">
                    	@if(count($oldbans) == 0)
                    		<p class="text-center">{{ trans('positivity::messages.oldbans.index_empty', ['name' => $name]) }}</p>
                    	@else
	                        <table class="table">
		                        <thead>
					                <tr>
					                    <th scope="col">{{ trans('messages.fields.name') }}</th>
					                    <th scope="col">{{ trans('positivity::messages.oldbans.reason') }}</th>
					                    <th scope="col">{{ trans('positivity::messages.oldbans.banned_by') }}</th>
					                    <th scope="col">{{ trans('positivity::messages.oldbans.revocation_time') }}</th>
					                    <th scope="col">{{ trans('positivity::messages.oldbans.cheat') }}</th>
					                    <th scope="col">{{ trans('positivity::messages.oldbans.creation_time') }}</th>
					                </tr>
		                        </thead>
		                        <tbody>
			                	@foreach($oldbans as $oldban)
				                    <tr class="sortable-dropdown tag-parent" data-oldban-id="{{ $oldban->id }}">
				                        <td>
						                    {{ $oldban->getPlayerName() }}
				                        </td>
				                        <td>
						                    {{ $oldban->reason }}
				                        </td>
				                        <td>
						                    {{ $oldban->banned_by }}
				                        </td>
				                        <td>
						                    {{ $oldban->revocation_time }}
				                        </td>
				                        <td>
						                    {{ $oldban->cheat_name }}
				                        </td>
				                        <td>
						                    {{ $oldban->execution_time }}
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
@endsection