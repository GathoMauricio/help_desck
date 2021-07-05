<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \App\Models\SymptomSuggestion;
use \App\Models\ServiceArea;
use \App\Models\ServiceType;
use \App\Models\ServiceTypeCategory;
use \App\Models\ServiceCategorySymptomp;

class ServiceSuggestionComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $currentArea = null, $currentType = null,$currentCategory = null, $currentSimptom = null, $types = null, $categories = null,$simptoms = null;

    public $symptom_id = null,$body = null;
    
    public $search_text;
    public $self_component = 'service_suggestion';

    public function render()
    {
        if (strlen($this->search_text) > 0)
            $suggestions = SymptomSuggestion::where('body', 'like', '%' . $this->search_text . '%')->orderBy('body')->paginate(5);
        else
            $suggestions = SymptomSuggestion::orderBy('body')->paginate(5);

            $areas = ServiceArea::orderBy('name')->get();

            if (!is_null($this->currentArea))
                $this->types = ServiceType::where('service_area_id', $this->currentArea)->orderBy('name')->get();
    
            if (!is_null($this->currentType))
                $this->categories = ServiceTypeCategory::where('service_type_id', $this->currentType)->orderBy('name')->get();

                //simtomps

        return view('livewire.service-suggestion-component',[
            'suggestions' => $suggestions,
            'areas' => $areas
        ]);
    }

    public function store()
    {
        $this->validate([
            'currentArea' => 'required',
            'currentType' => 'required',
            'currentCategory' => 'required',
            'symptom_id' => 'required',
            'body' => 'required'
        ],[
            'currentArea.required' => 'Campo requerido',
            'currentType.required' => 'Campo requerido',
            'currentCategory.required' => 'Campo requerido',
            'symptom_id.required' => 'Campo requerido',
            'body.required' => 'Campo requerido'
        ]);
        $suggestions = SymptomSuggestion::create(
            [
                'symptom_id' => $this->symptom_id,
                'body' => $this->body,
            ]
        );
        $this->emit('dismissCreateSuggestionModal');
        $this->emit('successNotification', 'La sugerencia de servicio ' . $suggestions->body . ' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $this->emit('editSuggestion');
    }

    public function destroy($id)
    {
        
        $suggestion = SymptomSuggestion::find($id);
        $body = $suggestion->body;
        $suggestion->delete();
        $this->emit('successNotification', 'La sugerencia de servicio ' . $body . ' se eliminó con éxito.');
        
    }


    public function default()
    {
        $this->body = "";
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

    public function changeCategory()
    {
        if(strlen($this->currentCategory) <= 0){ 
            $this->simptoms = null;
        }else{
            $this->simptoms = ServiceCategorySymptomp::where('service_type_category_id',$this->currentCategory)->orderBy('name')->get();
        }
    }
    

}
