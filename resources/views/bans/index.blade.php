@extends('layouts.app')

@section('title', trans('positivity::messages.bans.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = $setting->per_page;
$bans = \Azuriom\Plugin\Positivity\Models\Bans::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$haveMore = count($bans) == $perPage;
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-bans">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.bans.list') }}</h3>
                    <div class="table-responsive">
                        <table class="table">
			                <thead>
			                <tr>
			                    <th scope="col">{{ trans('messages.fields.name') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.bans.reason') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.bans.banned_by') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.bans.expiration_time') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.bans.cheat') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.bans.creation_time') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.more') }}</th>
			                </tr>
			                </thead>
			                <tbody class="sortable" id="games">
			                @forelse($bans as $ban)
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
			                        <td>
					                    <a href="{{ route('positivity.bans.show', $ban->id) }}">{{ trans('positivity::messages.more') }}</a>
			                        </td>
			                    </tr>
			                @empty
			                    <tr>
			                        <td colspan="7">{{ trans('positivity::messages.bans.empty') }}</td>
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
