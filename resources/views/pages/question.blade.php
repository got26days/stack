@extends('layouts.app')

@section('content')
<div>
	<h1>{{ $question->title }}</h1>



	<div class="pt-2">
		<p>asked: {{ $question->created_at->format('d.m.Y') }}</p>
		@if($question->last_activity_date)
		<p>active: {{ $question->last_activity_date->format('d.m.Y') }}</p>
		@endif
		@if($question->last_edit_date)
		<p>edited: {{ $question->last_edit_date->format('d.m.Y') }}</p>
		@endif
		<p>viewed: {{ $question->view_count }}</p>
	</div>

	<div>
		<h4 style="color: red;">SCORE: {{ $question->score }}</h4>
	</div>

	@if($question->user)
	<div>
		Asked: {{ $question->user->display_name }}
	</div>
	@endif



	@if(count($question->tagsArray) > 0)
	<div>
		<h6>Tags:
			@foreach ($question->tagsArray as $tag)
			<span class="badge bg-secondary">{{ $tag }}</span>
			@endforeach

		</h6>
	</div>
	@endif

	<div>
		<p>
			{!! $question->body !!}
		</p>
	</div>


	<div style="padding-left: 30px;">
		@foreach ($question->comments as $comment)
		@include('layouts.comment', ['comment' => $comment])
		@endforeach
	</div>

	<hr>

	<div>
		@foreach ($question->posts as $post)
		@include('layouts.post', ['post' => $post])


		<div style="padding-left: 30px;">
			@foreach ($post->comments as $comment)
			@include('layouts.comment', ['comment' => $comment])
			@endforeach
		</div>

		@endforeach
	</div>

</div>
@endsection