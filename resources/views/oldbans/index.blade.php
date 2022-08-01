@extends('layouts.app')

@section('title', trans('positivity::messages.oldbans.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = $setting->per_page;
$oldbans = \Azuriom\Plugin\Positivity\Models\OldBans::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$haveMore = count($oldbans) == $perPage;
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-oldbans">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.oldbans.list') }}</h3>
                    <div class="table-responsive">
                        <table class="table">
			                <thead>
				                <tr>
				                    <th scope="col">{{ trans('messages.fields.name') }}</th>
				                    <th scope="col">{{ trans('positivity::messages.oldbans.reason') }}</th>
				                    <th scope="col">{{ trans('positivity::messages.oldbans.banned_by') }}</th>
				                    <th scope="col">{{ trans('positivity::messages.oldbans.revocation_time') }}</th>
				                    <th scope="col">{{ trans('positivity::messages.oldbans.cheat') }}</th>
				                    <th scope="col">{{ trans('positivity::messages.oldbans.creation_time') }}</th>
				                    <th scope="col">{{ trans('positivity::messages.more') }}</th>
				                </tr>
			                </thead>
			                <tbody class="sortable" id="games">
			                @forelse($oldbans as $oldban)
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
			                        <td>
					                    <a href="{{ route('positivity.oldbans.show', $oldban->id) }}">{{ trans('positivity::messages.more') }}</a>
			                        </td>
			                    </tr>
			                @empty
			                    <tr>
			                        <td colspan="8">{{ trans('positivity::messages.oldbans.empty') }}</td>
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
