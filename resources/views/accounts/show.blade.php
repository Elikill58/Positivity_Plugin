<?php
$isValidUUID = preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', strtoupper($uuid));
$result = DB::connection("positivity")->select("SELECT * FROM negativity_accounts WHERE " . ($isValidUUID ? "id" : "playername") . " = ?", [$uuid]);
if(isset($result) && count($result) > 0) {
	$account = $result[0];
    $uuid = $account->id;
    $name = $account->playername;
} else {
	?>
    @include("positivity::error.not-found");
    <?php
    exit();
}

$minerateAvailable = array("diamond_ore","gold_ore","iron_ore","coal_ore","ancient_debris");

$minerateArray = array();
foreach (explode(";", $account->minerate) as $allMinerate) {
    $tab = explode("=", $allMinerate, 2);
    foreach ($tab as $minerate) {
        if(is_numeric($minerate) || count($tab) <= 1) continue;
        $minerateArray = array_merge($minerateArray, array($minerate => $tab[1]));
    }
}
?>

@extends('layouts.app')

@section('title', trans('positivity::messages.accounts.index', ['name' => $name]))

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-account">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div style="display: flex;">
	                    <div class="text-center" style="width: 30%;">
                    		<h3>{{ trans('positivity::messages.accounts.index', ['name' => $name]) }}</h3>
	                    	<img src="https://crafatar.com/avatars/{{ $account->id }}">
						    <h2>{{ $account->playername }}</h2>
						    <p>{{ $account->language }}</p>
						    <p>{{ $account->creation_time }}</p>
	                    </div>

	                    <div class="table-responsive" style="width: 70%;">
		                	<h2>{{ trans('positivity::messages.minerate.index') }}</h2>
	                        <table class="table">
		                        <thead>
		                            <tr>
		                                <th>{{ trans('positivity::messages.minerate.index') }}</th>
		                                <th>{{ trans('positivity::messages.amount') }}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr>
		                            	<?php
			                            foreach ($minerateAvailable as $mineKey) {
			                                echo "<td>" . trans('positivity::messages.minerate.' . strtolower($mineKey)) . "</td>";
			                                echo "<td>" . (isset($minerateArray[$mineKey]) ? $minerateArray[$mineKey] : 0) . "</td>";
			                                echo "</tr><tr>";
			                            }
			                            ?>
			                            <td>{{ trans('positivity::messages.minerate.all') }}</td>
			                            <td>{{ $account->minerate_full_mined }}</td>
		                            </tr>
		                        </tbody>
		                    </table>
				        </div>
				    </div>
                    <div class="table-responsive">
                    	<h3>{{ trans('positivity::messages.accounts.violations') }}</h3>
                        <table class="table">
	                        <?php
	                        $allViolationsSplitted = explode(";", $account->violations_by_cheat);
	                        $nbAllViolations = \Azuriom\Plugin\Positivity\Models\Accounts::countAllViolation($account->violations_by_cheat);
	                        ?>
	                        <thead>
	                            <tr>
	                                <?php

	                                if($nbAllViolations == 0){
	                                    ?>
	                                    <th style="width: 50%;">{{ trans('positivity::messages.cheat') }}</th>
	                                    <th style="width: 50%;">{{ trans('positivity::messages.amount') }}</th>
	                                    <?php
	                                } else {
	                                    ?>
	                                    <th style="width: 24%;">{{ trans('positivity::messages.cheat') }}</th>
	                                    <th style="width: 24%;">{{ trans('positivity::messages.amount') }}</th>
	                                    <th style="width: 4%;"></th>
	                                    <th style="width: 24%;">{{ trans('positivity::messages.cheat') }}</th>
	                                    <th style="width: 24%;">{{ trans('positivity::messages.amount') }}</th>
	                                    <?php
	                                }
	                                ?>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <?php
	                            $tempNb = 0;
	                            echo "<tr>";
	                            $allViolationsSplitted = explode(";", $account->violations_by_cheat);
	                            if($nbAllViolations == 0){
	                                ?>
	                                <td>-</td>
	                                <td>0</td>
	                                <?php
	                            } else {
	                                foreach ($allViolationsSplitted as $allCheat) {
	                                    $tab = explode("=", $allCheat, 2);
	                                    foreach ($tab as $cheat) {
	                                        if(isset($tab[1]) && !is_numeric($cheat) && $tab[1] > 0) {
	                                            echo "<td>" . $setting->getCheatName($cheat) . "</td>";
	                                            echo "<td>$tab[1]</td>";
	                                            $tempNb++;
	                                            if($tempNb == 2){
	                                                $tempNb = 0;
	                                                echo "</tr>";
	                                                if(end($allViolationsSplitted) != $allCheat)
	                                                    echo "<tr>";
	                                            } else
	                                                echo "<td></td>";
	                                        }
	                                    }
	                                }
	                            }
	                            echo "</tr>";
	                            ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection