<div class="container mx-auto px-5 py-8">
    <nav class="rounded-2xl bg-white px-8 py-5 border-4 border-red-500/20 flex flex-row justify-between">
        <div class="space-x-6">
            <a href="{{ route('home') }}" class="font-bold text-2xl text-red-500/80 hover:text-red-500">Home</a>
        </div>
        <div class="space-x-6">
        @auth()
            <a href="{{ route('parent-dashboard') }}" class="font-bold text-2xl text-red-500/80 hover:text-red-500">Dashboard</a>
            <a href="{{ route('logout') }}" class="font-bold text-2xl text-red-500/80 hover:text-red-500">Log Out</a>
        @else
            <a href="{{ route('login') }}" class="font-bold text-2xl text-red-500/80 hover:text-red-500">Log In</a>
        @endauth
        </div>
    </nav>
</div>
