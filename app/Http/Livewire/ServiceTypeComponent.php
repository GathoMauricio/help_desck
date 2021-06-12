<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ServiceType;
use App\Models\ServiceArea;

class ServiceTypeComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $category_id,$service_area_id,$name;

    public $search_text;
    public $self_component = 'service_type';
    
    public function render()
    {
        if (strlen($this->search_text) > 0) 
        $types = ServiceType::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5);
        else
        $types = ServiceType::orderBy('name')->paginate(5);

        $areas = ServiceArea::orderBy('name')->get();

        return view('livewire.service-type-component',
        ['types' => $types, 'areas' => $areas]
        );
    }

    public function store()
    {
        $this->validate(
            ['name' => 'required', 'service_area_id' => 'required'],
            ['name.required' => 'Campo requerido', 'service_area_id.required' => 'Campo requerido']
        );
        $type = ServiceType::create(['name' => $this->name, 'service_area_id' => $this->service_area_id]);
        $this->emit('dismissCreateTypeModal');
        $this->emit('successNotification','El tipo de servicio '.$type->name.' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $this->category_id = $id;
        $type = ServiceType::find($id);

        $this->service_area_id = $type->service_area_id;
        $this->name = $type->name;
        $this->emit('editType');
    }

    public function update()
    {
        $this->validate(
            ['name' => 'required', 'service_area_id' => 'required'],
            ['name.required' => 'Campo requerido', 'service_area_id.required' => 'Campo requerido']
        );
        $type = ServiceType::find($this->category_id);
        $type->service_area_id = $this->service_area_id;
        $type->name = $this->name;
        $type->save();
        $this->emit('dismissEditTypeModal');
        $this->emit('successNotification','El type de servicio '.$type->name.' se actualizó con éxito.');
        $this->default();
    }

    public function destroy($id)
    {
        $type = ServiceType::find($id);
        $name = $type->name;
        $type->delete();
        $this->emit('successNotification','El tipo de servicio '.$name.' se eliminó con éxito.');
    }

    public function default()
    {
        $this->name = "";
        $this->category_id = "";
        $this->service_area_id = "";
    }
}
