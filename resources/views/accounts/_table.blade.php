@if(!isset($accounts) || count($accounts) == 0)
    <p>{{ trans('positivity::messages.accounts.empty') }}</p>
@else
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
                @if(!isset($hideMore) || !$hideMore)
                    <th scope="col">{{ trans('positivity::messages.more') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="sortable" id="games">
            @foreach($accounts as $account)
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
                    	{{ $account->getVerifAmount() }}
                    </td>
                    <td>
                        {{ $account->creation_time }}
                    </td>
                    @if(!isset($hideMore) || !$hideMore)
                        <td>
                            <a href="{{ route('positivity.accounts.show', $account->id) }}">{{ trans('positivity::messages.more') }}</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif