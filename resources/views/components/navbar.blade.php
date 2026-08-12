<nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur">

    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a
            href="{{ route('mangas.index') }}"
            class="flex items-center gap-2 text-xl font-extrabold text-slate-900 transition hover:text-indigo-600"
        >
            <span class="text-2xl">📚</span>
            <span>MangaLib</span>
        </a>


        {{-- Navigation --}}
        <div class="flex items-center gap-2 sm:gap-5">

            {{-- Catalogue --}}
            <a
                href="{{ route('mangas.index') }}"
                class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600 sm:block"
            >
                Catalogue
            </a>


            @auth

                {{-- Mes emprunts --}}
                <a
                    href="{{ route('emprunts.index') }}"
                    class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600"
                >
                    <span class="hidden sm:inline">📖 </span>
                    Mes emprunts
                </a>


                {{-- Administration --}}
                @if(auth()->user()->role === 'admin')

                    <a
                        href="{{ route('admin') }}"
                        class="rounded-lg bg-indigo-50 px-3 py-2 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100"
                    >
                        👑 <span class="hidden sm:inline">Administration</span>
                    </a>

                @endif


                {{-- Utilisateur --}}
                <div class="hidden border-l border-slate-200 pl-4 text-sm text-slate-500 md:block">
                    👤 {{ auth()->user()->name }}
                </div>


                {{-- Déconnexion --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-red-50 hover:text-red-600"
                    >
                        🚪
                        <span class="hidden sm:inline">
                            Déconnexion
                        </span>
                    </button>
                </form>


            @else

                {{-- Connexion --}}
                <a
                    href="{{ route('login') }}"
                    class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                >
                    Connexion
                </a>


                {{-- Inscription --}}
                <a
                    href="{{ route('register') }}"
                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    Inscription
                </a>

            @endauth

        </div>

    </div>

</nav>