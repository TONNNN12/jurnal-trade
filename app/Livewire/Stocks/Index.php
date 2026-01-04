<?php

namespace App\Livewire\Stocks;

use Livewire\Component;
use App\Models\Stock;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $stock = Stock::findOrFail($id);

        // Cegah hapus jika sudah dipakai trade
        if ($stock->trades()->exists()) {
            session()->flash('error', 'Saham tidak bisa dihapus karena sudah dipakai di trade.');
            return;
        }

        $stock->delete();

        session()->flash('success', 'Saham berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.stocks.index', [
            'stocks' => Stock::where('code', 'like', "%{$this->search}%")
                ->orWhere('name', 'like', "%{$this->search}%")
                ->orderBy('code')
                ->paginate(10),
        ]);
    }
}
