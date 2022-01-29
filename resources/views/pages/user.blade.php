@extends('layouts.app')

@section('content')
<div>
	<h1>{{ __('User') }}</h1>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Value</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">Reputation</th>
				<td>{{ $user->reputation }}</td>
			</tr>
			<tr>
				<th scope="row">Views</th>
				<td>{{ $user->views }}</td>
			</tr>
			<tr>
				<th scope="row">Down votes</th>
				<td>{{ $user->down_votes }}</td>
			</tr>
			<tr>
				<th scope="row">Up votes</th>
				<td>{{ $user->up_votes }}</td>
			</tr>
			<tr>
				<th scope="row">Display name</th>
				<td>{{ $user->display_name }}</td>
			</tr>
			<tr>
				<th scope="row">Location</th>
				<td>{{ $user->location }}</td>
			</tr>
			@if($user->profile_image_url)
			<tr>
				<th scope="row">Avatar</th>
				<td><img src="{{ $user->profile_image_url }}" alt="image" style="width: 50px;"></td>
			</tr>
			@endif
			@if($user->website_url)
			<tr>
				<th scope="row">Web site</th>
				<td><a href="{{ $user->website_url }}">{{ $user->website_url }}</a></td>
			</tr>
			@endif
			@if($user->about_me)
			<tr>
				<th scope="row">About Me</th>
				<td>{!! $user->about_me !!}</td>
			</tr>
			@endif
			@if($user->last_access_date)
			<tr>
				<th scope="row">About Me</th>
				<td>{{ $user->last_access_date->format('d.m.Y') }}</td>
			</tr>
			@endif

		</tbody>
	</table>
</div>
@endsection