<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ServiceTypeCategory;
use App\Models\ServiceType;
use App\Models\ServiceArea;
use App\Models\ServiceCategorySymptomp;

class ServiceSimptomComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $currentArea = null, $currentType = null, $types = null, $categories = null;

    public $symptom_id,$service_type_category_id, $name;

    public $search_text;

    public $self_component = 'service_simptom';

    public function render()
    {
        if (strlen($this->search_text) > 0)
            $simptomps = ServiceCategorySymptomp::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5);
        else
            $simptomps = ServiceCategorySymptomp::orderBy('name')->paginate(5);

        $areas = ServiceArea::orderBy('name')->get();

        if (!is_null($this->currentArea))
            $this->types = ServiceType::where('service_area_id', $this->currentArea)->orderBy('name')->get();

        if (!is_null($this->currentType))
            $this->categories = ServiceTypeCategory::where('service_type_id', $this->currentType)->orderBy('name')->get();


        return view('livewire.service-simptom-component',['simptomps' => $simptomps,'areas' => $areas]);
    }

    public function store()
    {
        $this->validate(
            [
                'currentArea' => 'required',
                'currentType' => 'required',
                'name' => 'required',
                'service_type_category_id' => 'required'
            ],
            [
                'currentArea.required' => 'Campo requerido',
                'currentType.required' => 'Campo requerido',
                'service_type_category_id.required' => 'Campo requerido',
                'name.required' => 'Campo requerido',
            ]
        );

        $symptom = ServiceCategorySymptomp::create([
            'name' => $this->name, 'service_type_category_id' => $this->service_type_category_id
        ]);

        $this->emit('dismissCreateSymtomModal');
        $this->emit('successNotification', 'El síntoma de servicio ' . $symptom->name . ' se creó con éxito.');
        $this->default();

    }

    public function edit($id)
    {
        $this->symptom_id = $id;
        $symptom = ServiceCategorySymptomp::find($id);

        $this->currentArea =  $symptom->category->type->area['id'];
        $this->currentType =  $symptom->category->type['id'];
        $this->service_type_category_id = $symptom->category['id'];

        $this->name = $symptom->name;
        $this->emit('editSymptomp');
    }

    public function update()
    {
        $this->validate(
            [
                'currentArea' => 'required',
                'currentType' => 'required',
                'name' => 'required',
                'service_type_category_id' => 'required'
            ],
            [
                'currentArea.required' => 'Campo requerido',
                'currentType.required' => 'Campo requerido',
                'service_type_category_id.required' => 'Campo requerido',
                'name.required' => 'Campo requerido',
            ]
        );

        $symptom = ServiceCategorySymptomp::find($this->symptom_id);
        $symptom->service_type_category_id = $this->service_type_category_id;
        $symptom->name = $this->name;
        $symptom->save();

        $this->emit('dismissEditSymptomModal');
        $this->emit('successNotification', 'El síntoma de servicio ' . $symptom->name . ' se actualizó con éxito.');
        $this->default();
    }


    public function destroy($id)
    {
        $symptom = ServiceCategorySymptomp::find($id);
        $name = $symptom->name;
        $symptom->delete();
        $this->emit('successNotification', 'El síntoma de servicio ' . $name . ' se eliminó con éxito.');
    }

    public function default()
    {
        $this->name = "";
        //$this->service_type_category_id = "";
    }

    public function changeArea()
    {
        if(strlen($this->currentArea) <= 0){ 
            $this->currentType = null;
            $this->service_type_category_id = null;
            $this->types = null;
            $this->categories = null;
        }
    }
    public function changeType()
    {
        if(strlen($this->currentType) <= 0){ 
            $this->currentType = null;
            //$this->symptomp_id = null;
            $this->categories = null;
            //$this->simptoms = null;
        }
    }
}
