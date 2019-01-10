@inject('user', 'App\User')

<div>
    User: {{ $user->findOrFail(9) }}.
</div>