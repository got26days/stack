<div class="card" style="width: 100%; margin: 10px;">
	<h4 style="color: black; font-weight: bold; margin: 10px;">{{ $post->score }}</h4>

	@if($accepted_answer_id == $post->id)
	<div class="alert alert-success">ACCEPTED</div>
	@endif
	<div class="card-body">
		<p class="card-text">{!! $post->body !!}</p>
		<p class="card-text"><small class="text-muted">{{ $post->created_at->format('d.m.Y') }}</small>
			@if($post->user)
			<a href="/users/{{ $post->user->id }}/{{ $post->user->display_name }}" class="card-link">{{
				$post->user->display_name }}</a>
			@endif
		</p>

	</div>
</div>