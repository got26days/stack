<div>
	<div class="list-group">
		@include('layouts.menuItem', ['route' => 'questions'])

		@include('layouts.menuItem', ['route' => 'tags'])

		@include('layouts.menuItem', ['route' => 'users'])

		<a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A
			disabled
			link item</a>
	</div>

</div>