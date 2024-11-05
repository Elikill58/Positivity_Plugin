@include("positivity::_database")

@extends('layouts.app')

@section('title', trans('positivity::messages.verifications.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = setting('positivity.per_page');
$verifications = \Azuriom\Plugin\Positivity\Models\Verifications::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$pagination = \Azuriom\Plugin\Positivity\Models\Verifications::on("positivity")->paginate($perPage);

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
			                    <th scope="col" class="mobile-disabled">{{ trans('positivity::messages.created_at') }}</th>
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
			                        <td class="mobile-disabled">
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
				        {{ $pagination->links() }}
			        </div>
			    </div>
			</div>
		</div>
    </div>
@endsection