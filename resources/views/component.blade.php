

@component('components.panel')
	@slot('heading')
		Hello World
	@endslot
	<h1>
		hello World
	</h1>
	<h2>
		let's build something fancy
	</h2>
	@slot('footer')
		<p>Copyright @2018 All Rights Reserved</p>
	@endslot

@endcomponent
