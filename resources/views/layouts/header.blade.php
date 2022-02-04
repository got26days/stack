<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav me-auto">

			</ul>

			<form class="d-flex" method="GET" action="{{ route('search') }}">

				<search-input oldvalue="{{ request()->input('search') }}"></search-input>
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ms-auto">

			</ul>

		</div>
	</div>
</nav>