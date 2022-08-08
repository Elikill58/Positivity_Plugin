@if(!isset($bans) || count($bans) == 0)
	<p>{{ trans('positivity::messages.bans.empty') }}</p>
@else
	<table class="table">
	    <thead>
		    <tr>
		        <th scope="col">{{ trans('messages.fields.name') }}</th>
		        <th scope="col">{{ trans('positivity::messages.bans.reason') }}</th>
		        <th scope="col">{{ trans('positivity::messages.bans.banned_by') }}</th>
		        <th scope="col">{{ trans('positivity::messages.bans.cheat') }}</th>
		        <th scope="col">{{ trans('positivity::messages.bans.creation_time') }}</th>
		        <th scope="col">{{ trans('positivity::messages.bans.expiration_time') }}</th>
                @if(!isset($hideMore) || !$hideMore)
                	<th scope="col">{{ trans('positivity::messages.more') }}</th>
                @endif
		    </tr>
	    </thead>
	    <tbody class="sortable" id="games">
			@foreach($bans as $ban)
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
		                {{ $ban->cheat_name }}
		            </td>
		            <td>
		                {{ $ban->execution_time }}
		            </td>
		            <td>
		                {{ $ban->getDateFromMillis() }}
		            </td>
	                @if(!isset($hideMore) || !$hideMore)
			            <td>
			                <a href="{{ route('positivity.bans.show', $ban->id) }}">{{ trans('positivity::messages.more') }}</a>
			            </td>
	                @endif
		        </tr>
	        @endforeach
	    </tbody>
	</table>
	{{ $pagination->links() }}
@endif