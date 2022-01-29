<div class="card" style="width: 100%; margin: 10px;">
	<div class="card-body">
		<p class="card-text">{{ $comment->text }}</p>
		<p class="card-text"><small class="text-muted">{{ $comment->created_at->format('d.m.Y') }}</small>
			@if($comment->user)
			<a href="/users/{{ $comment->user->id }}/{{ $comment->user->display_name }}" class="card-link">{{
				$comment->user->display_name }}</a>
			@endif
		</p>

	</div>
</div>