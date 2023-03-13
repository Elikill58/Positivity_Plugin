@if(!isset($warns) || count($warns) == 0)
	<p>{{ trans('positivity::messages.warns.empty') }}</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ trans('messages.fields.name') }}</th>
                <th scope="col">{{ trans('positivity::messages.warns.reason') }}</th>
                <th scope="col">{{ trans('positivity::messages.warns.warned_by') }}</th>
                <th scope="col">{{ trans('positivity::messages.warns.creation_time') }}</th>
                <th scope="col">{{ trans('positivity::messages.warns.revocation_time') }}</th>
                @if(!isset($hideMore) || !$hideMore)
                	<th scope="col">{{ trans('positivity::messages.more') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="sortable" id="games">
	        @foreach($warns as $warn)
	            <tr class="sortable-dropdown tag-parent" data-warn-id="{{ $warn->id }}">
	                <td>
	                    {{ $warn->getPlayerName() }}
	                </td>
	                <td>
	                    {{ $warn->reason }}
	                </td>
	                <td>
	                    {{ $warn->getWarnedName() }}
	                </td>
	                <td>
	                    {{ $warn->execution_time }}
	                </td>
	                <td>
	                    {{ $warn->revocation_time }}
	                </td>
	                @if(!isset($hideMore) || !$hideMore)
		                <td>
		                    <a href="{{ route('positivity.warns.show', $warn->id) }}">{{ trans('positivity::messages.more') }}</a>
		                </td>
	                @endif
	            </tr>
	        @endforeach
        </tbody>
    </table>
	{{ $pagination->links() }}
@endif