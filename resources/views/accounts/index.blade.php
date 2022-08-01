@extends('layouts.app')

@section('title', trans('positivity::messages.accounts.list'))

<?php
$page = isset(request()->page) ? request()->page - 1 : 0;
$perPage = $setting->per_page;
$accounts = \Azuriom\Plugin\Positivity\Models\Accounts::on("positivity")->limit($perPage)->offset($page * $perPage)->get();
$haveMore = count($accounts) == $perPage;
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="positivity-accounts">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('positivity::messages.accounts.list') }}</h3>
                    <div class="table-responsive">
                        <table class="table">
			                <thead>
			                <tr>
			                    <th scope="col">{{ trans('messages.fields.name') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.accounts.lang') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.accounts.mined') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.accounts.most_clicks') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.accounts.violations') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.accounts.verifications') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.created_at') }}</th>
			                    <th scope="col">{{ trans('positivity::messages.more') }}</th>
			                </tr>
			                </thead>
			                <tbody class="sortable" id="games">
			                @forelse($accounts as $account)
			                    <tr class="sortable-dropdown tag-parent" data-account-id="{{ $account->id }}">
			                        <td>
					                    {{ $account->playername }}
			                        </td>
			                        <td>
					                    {{ $account->language }}
			                        </td>
			                        <td>
					                    {{ $account->minerate_full_mined }}
			                        </td>
			                        <td>
					                    {{ $account->most_clicks_per_second }}
			                        </td>
			                        <td>
					                    {{ $account->countAllViolation() }}
			                        </td>
			                        <td>
					                    <?php
					                    $verifResult = DB::connection("positivity")->select("SELECT count(*) as nb FROM negativity_verifications WHERE uuid = ?", [$account->id])[0];
					                    echo $verifResult->nb;
					                    ?>
			                        </td>
			                        <td>
					                    {{ $account->creation_time }}
			                        </td>
			                        <td>
					                    <a href="{{ route('positivity.accounts.show', $account->id) }}">{{ trans('positivity::messages.more') }}</a>
			                        </td>
			                    </tr>
			                @empty
			                    <tr>
			                        <td colspan="8">{{ trans('positivity::messages.accounts.empty') }}</td>
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
