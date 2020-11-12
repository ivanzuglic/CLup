<form method="post" action="{{route('users.update', $user)}}">
    {{ csrf_field() }}
    {{ method_field('patch') }}

    <input type="text" name="name"  value="{{ $user->name }}" />

    <input type="email" name="email"  value="{{ $user->email }}" />

    <input type="string" name="phone_number" value="{{ $user->phone_number }}" />

    <button type="submit">Send</button>
</form>
