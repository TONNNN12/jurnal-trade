<?php

namespace App\Livewire\Stocks;

use Livewire\Component;
use App\Models\Stock;

class Create extends Component
{
    public $code;
    public $name;
    public $sector;

    protected $rules = [
        'code' => 'required|string|max:10|unique:stocks,code',
        'name' => 'required|string|max:255',
        'sector' => 'nullable|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        Stock::create([
            'code' => strtoupper($this->code),
            'name' => $this->name,
            'sector' => $this->sector,
        ]);

        session()->flash('success', 'Saham berhasil ditambahkan');

        return redirect()->route('stocks.index');
    }

    public function render()
    {
        return view('livewire.stocks.create');
    }
}
