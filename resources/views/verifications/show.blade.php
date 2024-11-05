@include("positivity::_database")

<?php
$result = \Azuriom\Plugin\Positivity\Models\Verifications::on("positivity")->where("id", "=", $uuid)->first();
if($result) {
	$verif = $result;
} else {
	?>
    @include("positivity::error.not-found");
    <?php
    exit();
}
?>

@extends('layouts.app')

@section('title', trans('positivity::messages.verifications.index'))

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-verif">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div style="display: flex;">
	                    <div class="text-center" style="width: 30%;">
                    		<h3>{{ trans('positivity::messages.verifications.index') }}</h3>
	                    	<img src="https://crafatar.com/avatars/{{ $verif->uuid }}">
						    <a href="{{ route('positivity.accounts.show', ['account' => $verif->uuid]) }}"><h2>{{ $verif->getPlayerName() }}</h2></a>
						    <p>{{ trans('positivity::messages.verifications.started_by') . " " . $verif->startedBy }}</p>
						    <p>{{ $verif->creation_time }}</p>
	                    </div>

	                    <div style="width: 70%;">
	                        {!! $verif->addColorFromResult() !!}
				        </div>
				    </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection