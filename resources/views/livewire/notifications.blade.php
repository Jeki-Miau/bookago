<div x-data="{ open: false, loadNotifications() {
        $wire.loadNotifications();
    } }" @notification-window.window="open = true" class="relative">
    <button @click="open = !open; if(open) loadNotifications()"
        class="relative p-2 text-gray-500 hover:text-brand-lime transition rounded-full hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
            </path>
        </svg>
        @if($unreadCount > 0)
            <span
                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-500 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" x-transition.opacity
        class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5 border border-gray-100 overflow-hidden z-50"
        style="display: none;">
        <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
            <p class="text-sm font-bold text-brand-dark">Notifikasi</p>
            @if(count($notifications) > 0)
                <button wire:click="clearNotifications" @click.stop
                    class="text-xs text-gray-500 hover:text-red-500 font-medium transition">
                    Hapus semua
                </button>
            @endif
        </div>
        <div class="max-h-96 overflow-y-auto">
            @if(count($notifications) > 0)
                @foreach($notifications as $notification)
                    <div class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition {{ $notification['type'] === 'warning' ? 'bg-red-50' : '' }}">
                        <div class="flex items-start">
                            @if($notification['type'] === 'announcement')
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                    </svg>
                                </span>
                            @elseif($notification['type'] === 'message')
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                            @elseif($notification['type'] === 'warning')
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-600 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.342-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </span>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-brand-dark truncate">{{ $notification['title'] }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $notification['message'] }}</p>
                                <p class="text-[10px] text-gray-400 mt-1">{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="px-4 py-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <p class="text-sm text-gray-500">Belum ada notifikasi</p>
                </div>
            @endif
        </div>
    </div>
</div>