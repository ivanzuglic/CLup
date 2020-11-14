<form method="post" action="{{route('user_profile.update', $user)}}">
    @csrf
    @method('PATCH')

    <input type="text" name="name"  value="{{ $user->name }}" />
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif

    <input type="email" name="email"  value="{{ $user->email }}" />
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif

    <input type="tel" name="phone_number" value="{{ $user->phone_number }}" />
    @if ($errors->has('phone_number'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('phone_number') }}</strong>
        </span>
    @endif

    <button type="submit">Send</button>
</form>
