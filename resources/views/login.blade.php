@extends('layout')

@push('css')
    <style>
        #login {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0px 20px;
        }
        #login .wrapper {
            width: 100%;
            max-width: 500px;
        }
        #login h1 {
            font-size: 60px;
            font-weight: 700;
            margin: 0 !important;
            line-height: 1em;
        }
        #login span {
            font-size: 20px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <div id="login">
        <div class="wrapper">
            <h1 class="has-text-primary">Hello,</h1>
            <span class="has-text-primary">Let's do this thing first.</span>
            <div class="box has-background-primary mt-3" style="padding-bottom: 25px">
                <form method="POST" action="{{route('authenticate')}}">
                    @csrf
                    <div class="field">
                        <label class="has-text-white">Email</label>
                        <input type="text" name="email" value="{{ old('email')}}" class="input @error('email') is-danger @enderror">
                    </div>

                    <div class="field">
                        <label class="has-text-white">Password</label>
                        <input type="password" name="password" value="{{old('password')}}" class="input">
                    </div>

                    <div class="field" style="margin-top: 20px">
                        <button class="button w-full has-background-primary-light has-text-primary" style="font-weight:700; border:none">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        
    </script>
@endpush