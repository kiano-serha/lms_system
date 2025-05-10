{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Verification Link</title>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @include('components.tabler_libraries')
</head>

<body class=" d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    {{-- <img src="./static/logo.svg" width="110" height="32" alt="Tabler"
                        class="navbar-brand-image"> --}}
                    HyperPlus
                </a>
            </div>
            <div class="card card-md">
                <!-- Session Status -->
                {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
                {{-- <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div> --}}
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Verification Link Sent</h2>
                    <p class="text-secondary mb-4">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking
                        on the link we just emailed to you? If you didn't receive the email, we will gladly send you
                        another.
                    </p>

                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            A new verification link has been sent to the email address you provided during registration.
                        </div>
                    @endif

                    <div class="mt-4 d-flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button class="btn btn-primary" type="submit">Resend Verification Email</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-info mx-2">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
            </div>
        </div>
    </div>
</body>

</html>
