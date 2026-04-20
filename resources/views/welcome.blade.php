<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen">
        <main
            class="flex min-h-screen w-full items-center justify-center bg-cover bg-center bg-no-repeat px-4 py-8 sm:px-6"
            style="background-image: url('{{ asset('images/welcomeBackground.jpg') }}');"
        >
            <!--Laravel Breeze-->
            <div class="flex h-[600px] w-[600px] flex-col items-center justify-center gap-5 rounded-2xl border border-white/40 bg-white/30 p-10 shadow-lg backdrop-blur-md">
                <div class="flex w-full flex-col items-center gap-1">
                    <h1 class="p-4 text-center text-3xl font-bold leading-tight text-slate-900 sm:text-4xl">Welcome to the Ticket Management System</h1>
                    <p class="max-w-2xl text-center text-base text-slate-700 sm:text-xl">Manage your tickets efficiently with our intuitive system.</p>
                </div>
                <div class="mt-2 flex w-full flex-col items-center gap-3 sm:w-auto sm:flex-row sm:gap-4">
                    @if (Route::has('login'))
                        <a
                            href="{{ route('login') }}"
                            class="w-full rounded-md bg-slate-900 px-8 py-3.5 text-center text-base font-semibold text-white transition hover:bg-slate-700 sm:w-auto"
                        >
                            Login
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="w-full rounded-md border border-slate-300 bg-white px-8 py-3.5 text-center text-base font-semibold text-slate-900 transition hover:bg-slate-100 sm:w-auto"
                        >
                            Register
                        </a>
                    @endif
                </div>
            </div>
        </main>
    </body>
</html>
