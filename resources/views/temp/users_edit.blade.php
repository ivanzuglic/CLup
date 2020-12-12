@extends('layouts.base')

@section('title','User Edit')

@section('main')
    <div class="form widget widget-medium">
        <div class="widget-header title-only">
            <h2 class="widget-title">Change your Credentials</h2>
        </div>
        <form method="post" action="{{route('user_profile.update', $user)}}">
            @csrf
            @method('PATCH')

            <div>
                <label for="Name" class="col-md-4 col-form-label text-md-right">
                    {{ __('Name') }}:</label><br />
                <input id="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                       value="{{$user->name}}" placeholder="{{$user->name}}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
                @endif
            </div>

            <div>
                <label for="Email" class="col-md-4 col-form-label text-md-right">
                    {{ __('Email') }}:</label><br />
                <input id="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{$user->email}}" placeholder="{{$user->email}}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                @endif
            </div>

            <div>
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number:</label><br/>
                <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                       name="phone_number" value="{{$user->phone_number}}" placeholder="{{$user->phone_number}}">
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>
            <br>

            <div class="form-control">
                <button type="submit" class="btn medium">
                    <span>Update</span>
                </button>

            </div>

        </form>
    </div>

    <div class="form widget widget-medium">
        <div class="widget-header title-only">
            <h2 class="widget-title">Change your Password</h2>
        </div>
        <form method="post" action="{{route('user_profile.updatePass', $user)}}">
            @csrf
            @method('PATCH')

            <div>
                <label for="password" class="col-md-4 col-form-label text-md-right">
                    {{ __('Password') }}:</label><br />
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password"  placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                @endif
            </div>
            <div>
                <input type="checkbox" onclick="myFunction()">Show Password
            </div>

            <div>
                <label for="password_confirm" class="col-md-4 col-form-label text-md-right">
                    {{ __('Confirm Password') }}:</label><br />
                <input id="password_confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                       name="password_confirmation"  placeholder="Confirm Password" required>
            </div>
            <div>
                <input type="checkbox" onclick="myFunction1()">Show Password
            </div>




            <br>

            <div class="form-control">
                <button type="submit" class="btn medium">
                    <span>Update</span>
                </button>

            </div>

        </form>
    </div>
<body>
    <script>function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script>function myFunction1() {
            var x = document.getElementById("password_confirm");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
@endsection







{{--<form method="post" action="{{route('user_profile.update', $user)}}">--}}
{{--    @csrf--}}
{{--    @method('PATCH')--}}

{{--    <input type="text" name="name"  value="{{ $user->name }}" />--}}
{{--    @if ($errors->has('name'))--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--            <strong>{{ $errors->first('name') }}</strong>--}}
{{--        </span>--}}
{{--    @endif--}}

{{--    <input type="email" name="email"  value="{{ $user->email }}" />--}}
{{--    @if ($errors->has('email'))--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--            <strong>{{ $errors->first('email') }}</strong>--}}
{{--        </span>--}}
{{--    @endif--}}

{{--    <input type="tel" name="phone_number" value="{{ $user->phone_number }}" />--}}
{{--    @if ($errors->has('phone_number'))--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--            <strong>{{ $errors->first('phone_number') }}</strong>--}}
{{--        </span>--}}
{{--    @endif--}}

{{--    <button type="submit">Send</button>--}}
{{--</form>--}}
