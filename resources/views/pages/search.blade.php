@extends('layouts.app')

@section('content')
<div>
	<h1>{{ __('Search') }}</h1>
	<vue-search :results="{{ json_encode($results) }}" tab="{{ $tab }}" req="{{ $search }}"></vue-search>

</div>
@endsection