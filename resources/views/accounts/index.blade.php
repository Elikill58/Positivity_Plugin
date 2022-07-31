@extends('layouts.app')

@section('title', 'Stats')

<?php
$page = isset(request()->page) ? request()->page : 0;
$perPage = $setting->per_page;
$accounts = DB::connection("positivity")->select("SELECT * FROM negativity_accounts LIMIT " . $perPage . " OFFSET " . ($page * $perPage));
?>

@section('content')
	@include("positivity::header")
    <div class="row" id="stats">
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
			                    <th scope="col">{{ trans('positivity::messages.accounts.created_at') }}</th>
			                    <th scope="col">{{ trans('messages.fields.action') }}</th>
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
					                    <?php
								        $nb = 0;
								        foreach (explode(";", $account->violations_by_cheat) as $allCheat) {
								            $tab = explode("=", $allCheat, 2);
								            foreach ($tab as $cheat) {
								                if(isset($tab[1]) && is_numeric($tab[1])) {
								                    $nb = $nb + $tab[1];
								                }
								            }
								        }
								        echo $nb;
					                    ?>
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
					                    rien
			                        </td>
			                    </tr>
			                @empty
			                    <tr>
			                        <td>Vous n'avez pas de jeux</td>
			                    </tr>
			                @endforelse
			                </tbody>
				        </table>
			        </div>
			    </div>
			</div>
		</div>
    </div>
@endsection

@push('scripts')
    <script>
        function checkValidation(name) {
            window.location.href = "{{ route('positivity.index', ['uuid' => 'UUID']) }}".replace('UUID', name);
            return false;
        }
    </script>
@endpush