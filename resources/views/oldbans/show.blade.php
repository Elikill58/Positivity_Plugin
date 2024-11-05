@include("positivity::_database")

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
$pagination = \Azuriom\Plugin\Positivity\Models\OldBans::on("positivity")->where("id", "=", $uuid)->paginate(setting('positivity.per_page'));

?>

@extends('layouts.app')

@section('title', trans('positivity::messages.oldbans.index', ['name' => $name]))

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-oldban">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                	<div style="display: flex;">
	                    <div class="text-center" style="width: 30%;">
	                		<h3>{{ trans('positivity::messages.oldbans.index', ['name' => $name]) }}</h3>
	                    	<img src="https://crafatar.com/avatars/{{ $uuid }}">
	                		<a href="{{ route('positivity.accounts.show', $uuid) }}" class="btn btn-primary my-3">{{ trans('positivity::messages.accounts.see') }}</a>
	                    </div>

	                    <div class="table-responsive" style="width: 70%;">
                        	@include('positivity::oldbans._table', ['hideMore' => true])
					    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection