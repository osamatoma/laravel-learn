<link href="{{ url('css/all.css') }}" rel="stylesheet">

<div class="container">
	<ul>
    @foreach ($users as $user)
       <li> {{ $user->username }}</li>
    @endforeach
    </ul>


{{ $users->appends(['order' => 'ASC'])->links() }}
{{ $users->fragment('foo')->links() }}



</div>
