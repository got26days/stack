@extends('layouts.app')

@section('content')
<div>
	<h1>{{ __('Users') }}</h1>
	<vue-users :users="{{ json_encode($users) }}" tab="{{ $tab }}"></vue-users>
	<div class="pt-2" id="users-pagination">
		{{ $users->withQueryString()->links() }}
	</div>
</div>
@endsection