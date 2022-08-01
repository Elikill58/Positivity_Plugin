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
                        @include('positivity::oldbans._table', ['hideMore' => true])
				    </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection