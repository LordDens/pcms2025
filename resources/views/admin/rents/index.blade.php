<table class="table-auto w-full border">

    <thead>
        <tr class="bg-gray-100">
            <th>Pelanggan</th>
            <th>Mobil</th>
            <th>Jenis Mobil</th>
            <th>Tanggal Sewa</th>
            <th>Tanggal Kembali</th>
            <th>Sopir</th>
            <th>Harga Sewa</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rents as $rent)
        <tr>
            {{-- DEBUG: Menampilkan nilai boolean --}}
        <td>
            is_confirmed: {{ $rent->is_confirmed ? 'true' : 'false' }}
        </td>

            <td>{{ $rent->user->name ?? 'N/A' }}</td>
            <td>{{ $rent->car->nama_mobil ?? '-' }}</td>
            <td>{{ $rent->car->jenis ?? '-' }}</td>
            <td>{{ $rent->tanggal_sewa }}</td>
            <td>{{ $rent->tanggal_kembali }}</td>
            <td>{{ $rent->with_driver ? 'Ya' : 'Tidak' }}</td>
            <td>Rp{{ number_format($rent->total_pendapatan, 0, ',', '.') }}</td>
            <td>
                @if($rent->is_confirmed)
                    <span class="text-green-600 font-semibold">✔ Dikonfirmasi</span>
                @else
                    <span class="text-yellow-600 font-semibold">Belum Dikonfirmasi</span>
                @endif
            </td>
            <td class="space-x-2">
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
