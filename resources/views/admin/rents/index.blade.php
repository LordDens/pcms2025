@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Sewa Mobil</h2>
        <a href="{{ route('rents.createManual') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
            + Tambah Sewa
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="px-4 py-2 border">Pelanggan</th>
                    <th class="px-4 py-2 border">Mobil</th>
                    <th class="px-4 py-2 border">Jenis Mobil</th>
                    <th class="px-4 py-2 border">Tanggal Sewa</th>
                    <th class="px-4 py-2 border">Tanggal Kembali</th>
                    <th class="px-4 py-2 border">Sopir</th>
                    <th class="px-4 py-2 border">Harga Sewa</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center text-gray-800">
                @foreach($rents as $rent)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $rent->user->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border">{{ $rent->car->nama_mobil ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $rent->car->jenis ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $rent->tanggal_sewa }}</td>
                    <td class="px-4 py-2 border">{{ $rent->tanggal_kembali }}</td>
                    <td class="px-4 py-2 border">{{ $rent->with_driver ? 'Ya' : 'Tidak' }}</td>
                    <td class="px-4 py-2 border">Rp{{ number_format($rent->total_pendapatan, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">
                        @if($rent->is_confirmed)
                            <span class="text-green-600 font-semibold">✔ Dikonfirmasi</span>
                        @else
                            <span class="text-yellow-600 font-semibold">Belum Dikonfirmasi</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border space-x-2">
                        @if(!$rent->is_confirmed)
                        <form method="POST" action="{{ route('admin.rents.confirm', $rent->id) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-600 hover:underline" onclick="return confirm('Konfirmasi pesanan ini?')">
                                ✔ Konfirmasi
                            </button>
                        </form>
                        @else
                            <span class="text-gray-400">✔</span>
                        @endif

                        <form method="POST" action="{{ route('admin.rents.destroy', $rent->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
