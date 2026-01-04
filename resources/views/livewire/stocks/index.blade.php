<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Master Saham</h4>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">
            + Tambah Saham
        </a>
    </div>

    {{-- SEARCH --}}
    <div class="mb-3">
        <input
            type="text"
            class="form-control"
            placeholder="Cari kode atau nama saham..."
            wire:model.debounce.500ms="search"
        >
    </div>

    {{-- FLASH MESSAGE --}}
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Sektor</th>
                <th width="80">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stocks as $stock)
                <tr>
                    <td>{{ $stock->code }}</td>
                    <td>{{ $stock->name }}</td>
                    <td>{{ $stock->sector ?? '-' }}</td>
                    <td class="text-center">
                        <button
                            class="btn btn-sm btn-danger"
                            onclick="confirm('Yakin hapus saham ini?') || event.stopImmediatePropagation()"
                            wire:click="delete({{ $stock->id }})"
                        >
                            🗑
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $stocks->links() }}
</div>
