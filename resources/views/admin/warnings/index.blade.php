<x-admin-layout title="Kelola Peringatan - Admin">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Peringatan</h1>
                    <a href="{{ route('admin.warnings.create') }}" class="bg-red-500 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-red-600 transition">
                        + Berikan Peringatan
                    </a>
                </div>

                @if($warnings->count() > 0)
                    <div class="space-y-4">
                        @foreach($warnings as $warning)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 {{ $warning->is_active ? 'border-l-4 border-l-red-500' : '' }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $warning->reason }}</h3>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $warning->is_active ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $warning->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-3">{{ $warning->description }}</p>
                                    <p class="text-xs text-gray-400">Untuk: {{ $warning->user->name }} | Dari: {{ $warning->admin->name }} | {{ $warning->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <form action="{{ route('admin.warnings.toggle', $warning->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 text-sm font-semibold rounded-lg {{ $warning->is_active ? 'bg-gray-100 text-gray-600 hover:bg-gray-200' : 'bg-green-100 text-green-600 hover:bg-green-200' }}">
                                            {{ $warning->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.warnings.destroy', $warning->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-sm font-semibold rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl p-8 text-center">
                        <p class="text-gray-500">Belum ada peringatan.</p>
                    </div>
                @endif
</x-admin-layout>