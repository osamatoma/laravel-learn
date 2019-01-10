<form method="POST" action="{{ route('check') }}">
	{{ csrf_field() }}
	<input type="checkbox" name="s[]" value="1">
	<input type="checkbox" name="s[]" value="2">
	<input type="checkbox" name="s[]" value="3">
	<input type="checkbox" name="s[]" value="4">
	<input type="submit">
</form>