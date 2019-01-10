@extends('layouts.stack')



@section('content')

@endsection



@push('scripts')
	<script>
		console.log("Hello world")
	</script>
@endpush


@push('styles')
<style>
	body {
		background: red
	}
</style>
@endpush
