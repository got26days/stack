<a href="{{ route($route) }}"
	class="list-group-item list-group-item-action text-capitalize @if(request()->route()->getName() == $route) active @endif"
	aria-current="true">
	{{ $route }}
</a>