<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
            [x-cloak] { display: none !important; }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen" x-data="{ panel: 'home', auth: 'login' }">
        <main
            class="flex min-h-screen w-full items-center justify-center bg-cover bg-center bg-no-repeat px-4 py-8 sm:px-6"
            style="background-image: url('{{ asset('images/welcomeBackground.jpg') }}');"
        >
            <!--Laravel Breeze-->
            <div
                class="flex h-[600px] w-[680px] flex-col rounded-2xl border border-white/40 bg-white/30 p-8 shadow-lg backdrop-blur-md transition-transform duration-500 ease-out sm:p-10"
                :class="panel === 'auth' ? '-translate-x-3 sm:-translate-x-8 lg:-translate-x-12' : 'translate-x-0'"
            >
                <div class="flex h-full w-full items-center justify-center" x-show="panel === 'home'" x-transition.opacity.duration.300ms>
                    <div class="flex w-full flex-col items-center gap-5 text-center">
                        <h1 class="p-2 text-3xl font-bold leading-tight text-slate-900 sm:text-4xl">Welcome to the Ticket Management System</h1>
                        <p class="max-w-2xl text-base text-slate-700 sm:text-xl">Manage your tickets efficiently with our intuitive system.</p>
                        <div class="mt-2 flex w-full flex-col items-center gap-3 sm:w-auto sm:flex-row sm:gap-4">
                            @if (Route::has('login'))
                                <button
                                    type="button"
                                    @click="auth = 'login'; panel = 'auth'"
                                    class="w-full rounded-md bg-slate-900 px-8 py-3.5 text-center text-base font-semibold text-white transition hover:bg-slate-700 sm:w-auto"
                                >
                                    Login
                                </button>
                            @endif

                            @if (Route::has('register'))
                                <button
                                    type="button"
                                    @click="auth = 'register'; panel = 'auth'"
                                    class="w-full rounded-md border border-slate-300 bg-white px-8 py-3.5 text-center text-base font-semibold text-slate-900 transition hover:bg-slate-100 sm:w-auto"
                                >
                                    Register
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="h-full w-full" x-show="panel === 'auth'" x-transition.opacity.duration.300ms x-cloak>
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <button
                            type="button"
                            @click="panel = 'home'"
                            class="rounded-md border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-800 transition hover:bg-white"
                        >
                            Voltar
                        </button>
                        <div class="inline-flex rounded-md border border-slate-300 bg-white/70 p-1">
                            <button
                                type="button"
                                @click="auth = 'login'"
                                class="rounded px-4 py-2 text-sm font-semibold transition"
                                :class="auth === 'login' ? 'bg-slate-900 text-white' : 'text-slate-800 hover:bg-white'"
                            >
                                Login
                            </button>
                            <button
                                type="button"
                                @click="auth = 'register'"
                                class="rounded px-4 py-2 text-sm font-semibold transition"
                                :class="auth === 'register' ? 'bg-slate-900 text-white' : 'text-slate-800 hover:bg-white'"
                            >
                                Register
                            </button>
                        </div>
                    </div>

                    <form x-show="auth === 'login'" method="POST" action="{{ route('login') }}" class="space-y-4" x-cloak>
                        @csrf
                        <div>
                            <label for="welcome-login-email" class="mb-1 block text-sm font-semibold text-slate-800">Email</label>
                            <input id="welcome-login-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div>
                            <label for="welcome-login-password" class="mb-1 block text-sm font-semibold text-slate-800">Password</label>
                            <input id="welcome-login-password" type="password" name="password" required autocomplete="current-password" class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                        </div>
                        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-slate-900 focus:ring-slate-800">
                            Remember me
                        </label>
                        <button type="submit" class="w-full rounded-md bg-slate-900 px-6 py-3 text-base font-semibold text-white transition hover:bg-slate-700">Entrar</button>
                    </form>

                    <form x-show="auth === 'register'" method="POST" action="{{ route('register') }}" class="space-y-3" x-cloak>
                        @csrf
                        <div>
                            <label for="welcome-register-name" class="mb-1 block text-sm font-semibold text-slate-800">Name</label>
                            <input id="welcome-register-name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div>
                            <label for="welcome-register-email" class="mb-1 block text-sm font-semibold text-slate-800">Email</label>
                            <input id="welcome-register-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div>
                            <label for="welcome-register-department" class="mb-1 block text-sm font-semibold text-slate-800">Department</label>
                            <select id="welcome-register-department" name="department" required class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                                <option value="" disabled {{ old('department') ? '' : 'selected' }}>Select a department</option>
                                <option value="Financeiro" {{ old('department') === 'Financeiro' ? 'selected' : '' }}>Financeiro</option>
                                <option value="Comercial" {{ old('department') === 'Comercial' ? 'selected' : '' }}>Comercial</option>
                                <option value="Tecnologia" {{ old('department') === 'Tecnologia' ? 'selected' : '' }}>Tecnologia</option>
                                <option value="RH" {{ old('department') === 'RH' ? 'selected' : '' }}>RH</option>
                            </select>
                        </div>
                        <div>
                            <label for="welcome-register-password" class="mb-1 block text-sm font-semibold text-slate-800">Password</label>
                            <input id="welcome-register-password" type="password" name="password" required autocomplete="new-password" class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div>
                            <label for="welcome-register-password-confirmation" class="mb-1 block text-sm font-semibold text-slate-800">Confirm Password</label>
                            <input id="welcome-register-password-confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full rounded-md border border-slate-300 bg-white/90 px-3 py-2.5 text-slate-900 focus:border-slate-800 focus:outline-none focus:ring-1 focus:ring-slate-800">
                        </div>
                        <button type="submit" class="w-full rounded-md bg-slate-900 px-6 py-3 text-base font-semibold text-white transition hover:bg-slate-700">Criar conta</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
