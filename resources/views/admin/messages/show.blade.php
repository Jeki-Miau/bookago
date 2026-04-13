<x-admin-layout title="Baca Pesan - Admin">

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h1 class="text-xl font-bold text-gray-800">{{ $message->subject }}</h1>
                        <p class="text-sm text-gray-500 mt-1">Dari: {{ $message->user->name }} ({{ $message->user->email }}) | {{ $message->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="text-gray-700">
                        {{ $message->content }}
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Balas Pesan</h3>
                    <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="4" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition mb-4" placeholder="Tulis balasan..."></textarea>
                        <button type="submit" class="bg-green-500 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-green-600 transition">
                            Kirim Balasan
                        </button>
                    </form>
                </div>
</x-admin-layout>