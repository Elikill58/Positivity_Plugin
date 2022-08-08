@if(!isset($oldbans) || count($oldbans) == 0)
	<p>{{ trans('positivity::messages.oldbans.empty') }}</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ trans('messages.fields.name') }}</th>
                <th scope="col">{{ trans('positivity::messages.oldbans.reason') }}</th>
                <th scope="col">{{ trans('positivity::messages.oldbans.banned_by') }}</th>
                <th scope="col">{{ trans('positivity::messages.oldbans.cheat') }}</th>
                <th scope="col">{{ trans('positivity::messages.oldbans.creation_time') }}</th>
                <th scope="col">{{ trans('positivity::messages.oldbans.revocation_time') }}</th>
                @if(!isset($hideMore) || !$hideMore)
                	<th scope="col">{{ trans('positivity::messages.more') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="sortable" id="games">
	        @foreach($oldbans as $oldban)
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
	                    {{ $oldban->cheat_name }}
	                </td>
	                <td>
	                    {{ $oldban->execution_time }}
	                </td>
	                <td>
	                    {{ $oldban->revocation_time }}
	                </td>
	                @if(!isset($hideMore) || !$hideMore)
		                <td>
		                    <a href="{{ route('positivity.oldbans.show', $oldban->id) }}">{{ trans('positivity::messages.more') }}</a>
		                </td>
	                @endif
	            </tr>
	        @endforeach
        </tbody>
    </table>
	{{ $pagination->links() }}
@endif