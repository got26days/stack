@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

			<h1>{{ __('Questions') }}</h1>

			<div class="list-group">
				@foreach ($posts as $post)
				<a href="#" class="list-group-item list-group-item-action" aria-current="true">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">{{ $post->title }}</h5>
						<small>{{ $post->created_at->format('d.m.Y') }}</small>
					</div>
					@if($post->user)
					<small>asked: {{$post->user->name}}</small>
					@endif
				</a>
				@endforeach

			</div>

			<div class="p-2">
				{{ $posts->links() }}
			</div>




		</div>
	</div>
</div>
@endsection