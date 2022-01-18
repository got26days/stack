@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

			<h1>{{ __('Questions') }}</h1>

			<div class="text-end p-2">

				<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
					<input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
					<label class="btn btn-outline-primary" for="btnradio1">Hot</label>

					<input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
					<label class="btn btn-outline-primary" for="btnradio2">Week</label>

					<input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
					<label class="btn btn-outline-primary" for="btnradio3">Month</label>
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

			<div class="p-2">
				{{ $posts->links() }}
			</div>




		</div>
	</div>
</div>
@endsection