<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ServiceArea;

class ServiceAreaComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $area_id,$name;

    public $search_text;

    public $self_component = 'service_area';

    public function render()
    {
        if (strlen($this->search_text) > 0) 
        $areas = ServiceArea::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5);
        else
        $areas = ServiceArea::orderBy('name')->paginate(5);
        return view('livewire.service-area-component',['areas' => $areas]);
    }

    public function store()
    {
        $this->validate(
            ['name' => 'required'],
            ['name.required' => 'Campo requerido']
        );
        $area = ServiceArea::create(['name' => $this->name]);
        $this->emit('dismissCreateAreaModal');
        $this->emit('successNotification','El area de servicio '.$area->name.' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $this->area_id = $id;
        $area = ServiceArea::find($id);

        $this->name = $area->name;
        $this->emit('editArea');
    }

    public function update()
    {
        $this->validate(
            ['name' => 'required'],
            ['name.required' => 'Campo requerido']
        );
        $area = ServiceArea::find($this->area_id);
        $area->name = $this->name;
        $area->save();
        $this->emit('dismissEditAreaModal');
        $this->emit('successNotification','El area de servicio '.$area->name.' se actualizó con éxito.');
        $this->default();
    }

    public function destroy($id)
    {
        $area = ServiceArea::find($id);
        $name = $area->name;
        $area->delete();
        $this->emit('successNotification','El área de servicio '.$name.' se eliminó con éxito.');
    }

    public function default()
    {
        $this->name = "";
    }
}
