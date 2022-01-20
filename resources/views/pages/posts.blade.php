@extends('layouts.app')

@section('content')
<div>
	<h1>{{ __('Questions') }}</h1>
	<div class="d-flex w-100 justify-content-between align-items-center py-2">

		<div>
			{{ $posts->total() }} @lang('questions')
		</div>
		<div class="text-end">
			<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
				<a href="/questions?tab=newest"
					class="btn btn-outline-primary @if($tab == 'newest') active @endif">Newest</a>
				<a href="/questions?tab=hot" class="btn btn-outline-primary @if($tab == 'hot') active @endif">Hot</a>
				<a href="/questions?tab=active"
					class="btn btn-outline-primary @if($tab == 'active') active @endif">Active</a>

				<a href="/questions?tab=week" class="btn btn-outline-primary @if($tab == 'week') active @endif">Week</a>
				<a href="/questions?tab=month"
					class="btn btn-outline-primary @if($tab == 'month') active @endif">Month</a>
			</div>
		</div>
	</div>

	<div class="py-2">
		<vue-posts-filter :selected-back-tags="{{ json_encode($tags, true) }}"></vue-posts-filter>
	</div>

	<div class="list-group">
		@foreach ($posts as $post)
		<div class="list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-start">
				<div class="px-2">
					<span class="badge bg-success">{{ $post->score }}</span>
				</div>
				<div>
					<h5 class="mb-1">{{ $post->title }}</h5>
					<div>
						type: {{ $post->post_type_id }}
					</div>
					@if(count($post->tagsRelationship) > 0)
					<div>
						<h6>Tags:
							@foreach ($post->tagsRelationship as $tag)
							<span class="badge bg-secondary">{{ $tag->tag_name }}</span>
							@endforeach

						</h6>
					</div>
					@endif

					<small>{{ $post->created_at->format('d.m.Y H:i') }}</small>
					@if($post->user)
					<div>
						<small>@lang('asked'):</small>
						<a href="/users/{{ $post->user->id }}/{{ $post->user->display_name }}">{{
							$post->user->display_name }}</a>

					</div>
					@endif
				</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="pt-2">
		{{ $posts->withQueryString()->links() }}
	</div>
</div>
@endsection