<form method="POST" action="/rules">
	@csrf
	<input type="text" name="name">
	<input type="submit">
</form>



@if(count($errors))

	@foreach ($errors->all() as $error)
		{{ $error }} <br />
	@endforeach

@endif
