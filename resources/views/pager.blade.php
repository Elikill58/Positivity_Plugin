<div class="text-center">
	<?php
	if(isset($page) && isset($haveMore)) {
		if($page > 0) {
			?>
			<a href="?page={{ ($page) }}">
				{{ trans('positivity::messages.page.previous') }}
			</a>
			<?php
		}
		echo trans('positivity::messages.page.info', ['page' => $page + 1]);
		if($haveMore) {
			?>
			<a href="?page={{ ($page + 2) }}">
				{{ trans('positivity::messages.page.next') }}
			</a>
			<?php
		}
	}
	?>
</div>