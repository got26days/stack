@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

			<h1>{{ __('Questions') }}</h1>

			<div class="text-end p-2">

				<div class="btn-group" role="group" aria-label="Basic radio toggle button group">

					<a href="/questions?tab=hot"
						class="btn btn-outline-primary @if(request()->tab == 'hot') active @endif">Hot</a>
					<a href="/questions?tab=week"
						class="btn btn-outline-primary @if(request()->tab == 'week') active @endif">Week</a>
					<a href="/questions?tab=month"
						class="btn btn-outline-primary @if(request()->tab == 'month') active @endif">Month</a>

				</div>
			</div>

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



		</div>
	</div>
</div>
@endsection