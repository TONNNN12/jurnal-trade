<div>
    <h4 class="mb-3">Tambah Saham</h4>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="card card-body">
        <div class="mb-3">
            <label>Kode Saham</label>
            <input type="text" class="form-control" wire:model.defer="code">
            @error('code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Nama Saham</label>
            <input type="text" class="form-control" wire:model.defer="name">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <input type="text" class="form-control" wire:model.defer="sector">
            @error('sector') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
