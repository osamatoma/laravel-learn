@extends('layouts.app')


@section('content')
<div class="container">

	<h1>
		Users
	</h1>

	@foreach ($users as $user)
		<li>{{ $user->email }}</li>
	@endforeach

	{{ $users->onEachSide(2)->links() }}

</div>

@stop
