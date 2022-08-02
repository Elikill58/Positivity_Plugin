@extends('layouts.app')

@section('title', trans('positivity::messages.verifications.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = setting('positivity.per_page');
$verifications = \Azuriom\Plugin\Positivity\Models\Verifications::on("positivity")->limit($perPage)->offset($page * $perPage)->get();// DB::connection("positivity")->select("SELECT * FROM negativity_verifications LIMIT " . $perPage . " OFFSET " . ($page * $perPage));
$haveMore = count($verifications) == $perPage;

$namePerUuid = array();
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
			                    <th scope="col">{{ trans('positivity::messages.more') }}</th>
			                </tr>
			                </thead>
			                <tbody class="sortable" id="games">
			                @forelse($verifications as $verif)
			                    <tr class="sortable-dropdown tag-parent" data-verif-id="{{ $verif->id }}">
			                        <td>
					                    {{ $verif->getPlayerName() }}
			                        </td>
			                        <td>
					                    {{ $verif->startedBy }}
			                        </td>
			                        <td>
					                    {{ $verif->parseVersionName() }}
			                        </td>
			                        <td>
					                    {{ $verif->creation_time }}
			                        </td>
			                        <td>
					                    <a href="{{ route('positivity.verifications.show', $verif->id) }}">{{ trans('positivity::messages.more') }}</a>
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