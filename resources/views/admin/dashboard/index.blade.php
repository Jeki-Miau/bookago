<x-admin-layout title="Admin Dashboard - BOOKAGO">

                <!-- Welcome Hero -->
                <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="relative bg-white rounded-2xl p-6 lg:p-8 mb-8 shadow-sm border border-gray-100 overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-brand-lime/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-brand-lime uppercase tracking-widest mb-1">Panel Admin</p>
                            <h1 class="text-2xl lg:text-3xl font-black text-brand-dark">Dashboard Admin</h1>
                            <p class="text-sm text-gray-500 mt-2 max-w-lg">Kelola platform BOOKAGO dengan mudah. Pantau statistik, lihat aktivitas terbaru, dan lakukan aksi cepat.</p>
                        </div>
                        <div class="hidden lg:block">
                            <div class="w-20 h-20 bg-gradient-to-br from-brand-lime to-brand-primary rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
                    <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover-lift group">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Users</p>
                                <p class="text-2xl font-black text-brand-dark">{{ $stats['users'] }}</p>
                            </div>
                            <div class="w-10 h-10 bg-brand-lime/10 rounded-xl flex items-center justify-center icon-bg">
                                <svg class="w-5 h-5 text-brand-lime" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover-lift group">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Discussions</p>
                                <p class="text-2xl font-black text-brand-dark">{{ $stats['discussions'] }}</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center icon-bg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover-lift group">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Replies</p>
                                <p class="text-2xl font-black text-brand-dark">{{ $stats['replies'] }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center icon-bg">
                                <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover-lift group">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Announcements</p>
                                <p class="text-2xl font-black text-brand-dark">{{ $stats['activeAnnouncements'] }}</p>
                            </div>
                            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center icon-bg">
                                <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover-lift group">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Unread Messages</p>
                                <p class="text-2xl font-black text-brand-dark">{{ $stats['unreadMessages'] }}</p>
                            </div>
                            <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center icon-bg">
                                <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover-lift group">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Active Warnings</p>
                                <p class="text-2xl font-black text-brand-dark">{{ $stats['activeWarnings'] }}</p>
                            </div>
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center icon-bg">
                                <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Menu Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 700)" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover-lift">
                        <h3 class="text-lg font-bold text-brand-dark mb-4 flex items-center">
                            <svg class="w-5 h-5 text-brand-lime mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Aksi Cepat
                        </h3>
                        <div class="grid grid-cols-1 gap-3">
                            <a href="{{ route('admin.announcements.create') }}" class="flex items-center justify-between px-4 py-3 bg-brand-primary text-white rounded-lg font-semibold hover:bg-brand-dark transition hover:-translate-y-1 shadow-sm group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                    </svg>
                                    Buat Pengumuman
                                </div>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.warnings.create') }}" class="flex items-center justify-between px-4 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition hover:-translate-y-1 shadow-sm group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    Berikan Peringatan
                                </div>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.messages') }}" class="flex items-center justify-between px-4 py-3 bg-brand-lime text-white rounded-lg font-semibold hover:bg-brand-primary transition hover:-translate-y-1 shadow-sm group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Lihat Pesan
                                </div>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 800)" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover-lift">
                        <h3 class="text-lg font-bold text-brand-dark mb-4 flex items-center">
                            <svg class="w-5 h-5 text-brand-lime mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            Link Menu
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('forum.index') }}" class="flex items-center justify-between px-4 py-2.5 bg-gray-50 rounded-lg hover:bg-brand-lime/10 transition group border border-gray-100">
                                <span class="font-semibold text-brand-dark">Forum Diskusi</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-lime group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('home') }}" class="flex items-center justify-between px-4 py-2.5 bg-gray-50 rounded-lg hover:bg-brand-lime/10 transition group border border-gray-100">
                                <span class="font-semibold text-brand-dark">Katalog Buku</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-lime group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.users') }}" class="flex items-center justify-between px-4 py-2.5 bg-gray-50 rounded-lg hover:bg-brand-lime/10 transition group border border-gray-100">
                                <span class="font-semibold text-brand-dark">Kelola Users</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-lime group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Data -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 900)" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover-lift">
                        <h3 class="text-lg font-bold text-brand-dark mb-4 flex items-center">
                            <span class="w-2 h-2 bg-brand-lime rounded-full mr-2 animate-pulse"></span>
                            Diskusi Terbaru
                        </h3>
                        @if($recentDiscussions->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentDiscussions as $discussion)
                                <div class="flex items-center justify-between py-2 border-b border-gray-50 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-brand-lime/10 rounded-full flex items-center justify-center text-brand-lime font-bold text-xs">
                                            {{ strtoupper(substr($discussion->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-brand-dark text-sm line-clamp-1">{{ $discussion->title }}</p>
                                            <p class="text-xs text-gray-500">by {{ $discussion->user->name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('forum.show', $discussion->slug) }}" class="text-brand-lime hover:text-brand-primary text-sm font-semibold hover:translate-x-1 transition">Lihat</a>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm">Belum ada diskusi.</p>
                            </div>
                        @endif
                    </div>
                    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 1000)" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover-lift">
                        <h3 class="text-lg font-bold text-brand-dark mb-4 flex items-center">
                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-2 animate-pulse"></span>
                            Pesan Terbaru
                        </h3>
                        @if($recentMessages->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentMessages as $message)
                                <div class="flex items-center justify-between py-2 border-b border-gray-50 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-xs">
                                            {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-brand-dark text-sm line-clamp-1">{{ $message->subject }}</p>
                                            <p class="text-xs text-gray-500">from {{ $message->user->name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.messages.show', $message->id) }}" class="text-brand-lime hover:text-brand-primary text-sm font-semibold hover:translate-x-1 transition">Lihat</a>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm">Belum ada pesan.</p>
                            </div>
                        @endif
                    </div>
                </div>
</x-admin-layout>