<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ServiceTypeCategory;
use App\Models\ServiceType;
use App\Models\ServiceArea;

class ServiceCategoryComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $category_id,$service_type_id,$name;

    public $currentArea = null, $types = null;

    public $search_text;

    public $self_component = 'service_category';

    public function render()
    {
        if (strlen($this->search_text) > 0) 
        $categories = ServiceTypeCategory::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5);
        else
        $categories = ServiceTypeCategory::orderBy('name')->paginate(5);

        if(!is_null($this->currentArea))
        $this->types = ServiceType::where('service_area_id',$this->currentArea)->orderBy('name')->get();
        
        $areas = ServiceArea::orderBy('name')->get();

        return view('livewire.service-category-component',
        ['categories' => $categories, 'areas' => $areas]
        );
    }

    public function store()
    {
        $this->validate(
            [
                'currentArea' => 'required', 
                'name' => 'required', 
                'service_type_id' => 'required'
            ],
            [
                'currentArea.required' => 'Campo requerido', 
                'service_type_id.required' => 'Campo requerido', 
                'name.required' => 'Campo requerido', 
                ]
        );


        $category = ServiceTypeCategory::create(['name' => $this->name, 'service_type_id' => $this->service_type_id]);
        $this->emit('dismissCreateCategoryModal');
        $this->emit('successNotification','La categoría de servicio '.$category->name.' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $this->category_id = $id;
        $category = ServiceTypeCategory::find($id);

        //$this->service_area_id = $type->service_area_id;

        //$this->types = ServiceType::where('service_area_id',$category->service_type_id)->orderBy('name')->get();

        //$this->currentArea = Service
        $this->name = $category->name;
        $this->emit('editCategory');
    }

    public function update()
    {
        $this->validate(
            [
                'currentArea' => 'required', 
                'name' => 'required', 
                'service_type_id' => 'required'
            ],
            [
                'currentArea.required' => 'Campo requerido', 
                'service_type_id.required' => 'Campo requerido', 
                'name.required' => 'Campo requerido', 
                ]
        );

        $category = ServiceTypeCategory::find($this->category_id);

        $category->service_type_id = $this->service_type_id;
        $category->name = $this->name;

        $category->save();
        $this->emit('dismissEditCategoryModal');
        $this->emit('successNotification','La categoría de servicio '.$category->name.' se actualizó con éxito.');
        $this->default();
    }

    public function destroy($id)
    {
        $category = ServiceTypeCategory::find($id);
        $name = $category->name;
        $category->delete();
        $this->emit('successNotification','La categoría de servicio '.$name.' se eliminó con éxito.');
    }

    public function default()
    {
        $this->name = "";
        $this->category_id = "";
        $this->service_area_id = "";
    }

    public function changeArea()
    {
        if(strlen($this->currentArea) <= 0){ 
            $this->types = null;
        }
    }
}
