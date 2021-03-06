@extends('layouts.app')

@section('content')
<div>
	<h1>{{ __('Tags') }}</h1>
	<vue-tags :tags="{{ json_encode($tags) }}" tab="{{ $tab }}"></vue-tags>
	<div class="pt-2" id="tags-pagination">
		{{ $tags->withQueryString()->links() }}
	</div>
</div>
@endsection