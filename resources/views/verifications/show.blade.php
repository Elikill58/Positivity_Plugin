<?php
$result = DB::connection("positivity")->select("SELECT * FROM negativity_verifications WHERE id = ?", [$uuid]);
if(isset($result) && count($result) > 0) {
	$verif = $result[0];
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
						    <a href="{{ route('positivity.accounts.show', ['account' => $verif->uuid]) }}"><h2>{{ $setting->getPlayerName($verif->uuid) }}</h2></a>
						    <p>{{ trans('positivity::messages.verifications.started_by') . " " . $verif->startedBy }}</p>
						    <p>{{ $verif->creation_time }}</p>
	                    </div>

	                    <div style="width: 70%;">
	                        {!! $setting->addColorFromResult($verif->result) !!}
				        </div>
				    </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection