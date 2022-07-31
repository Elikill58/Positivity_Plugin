@extends('layouts.app')

@section('title', trans('positivity::messages.verifications.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = $setting->per_page;
$verifications = DB::connection("positivity")->select("SELECT * FROM negativity_verifications LIMIT " . $perPage . " OFFSET " . ($page * $perPage));
$haveMore = count($verifications) == $perPage;

function parseVersionName($version){
    return str_replace("_", ".", str_replace("V", "", $version));
}
$namePerUuid = array();
function getPlayerName($namePerUuid, $uuid) {
    if ($uuid === null || $uuid === "" || strrpos($uuid, "#", -strlen($uuid)) !== false) {
        return $default_name;
    }
    if (array_key_exists($uuid, $namePerUuid)) return $namePerUuid[$uuid];

    $result = "?";

    $account = DB::connection("positivity")->select("SELECT * FROM negativity_accounts WHERE id = ?;", [$uuid]);
    if ($account && count($account) > 0) {
        $result = $account[0]->playername;
    }

    $namePerUuid[$uuid] = $result;
    return $result;
}
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-verifications">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.verifications.list') }}</h3>
                    <div class="table-responsive">
                        <table class="table">
			                <thead>
			                <tr>
			                    <th scope="col">{{ trans('messages.fields.name') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.verifications.started_by') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.verifications.player_version') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.created_at') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.created_at') }}</th>
			                </tr>
			                </thead>
			                <tbody class="sortable" id="games">
			                @forelse($verifications as $verif)
			                    <tr class="sortable-dropdown tag-parent" data-verif-id="{{ $verif->id }}">
			                        <td>
					                    {{ getPlayerName($namePerUuid, $verif->uuid) }}
			                        </td>
			                        <td>
					                    {{ $verif->startedBy }}
			                        </td>
			                        <td>
					                    {{ parseVersionName($verif->player_version) }}
			                        </td>
			                        <td>
					                    {{ $verif->creation_time }}
			                        </td>
			                        <td>
					                    {{ $verif->creation_time }}
			                        </td>
			                    </tr>
			                @empty
			                    <tr>
			                        <td colspan="8">{{ trans('positivity::messages.verifications.empty') }}</td>
			                    </tr>
			                @endforelse
			                </tbody>
				        </table>
			        </div>
			    </div>
			</div>
			@include("positivity::pager")
		</div>
    </div>
@endsection