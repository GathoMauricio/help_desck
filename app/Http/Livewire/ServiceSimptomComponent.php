<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ServiceCategorySymptomp;

class ServiceSimptomComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $search_text;

    public $self_component = 'service_simptom';

    public function render()
    {
        return view('livewire.service-simptom-component');
    }
}
