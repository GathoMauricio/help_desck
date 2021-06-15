<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\CasePriority;
use App\Models\ServiceArea;
use App\Models\ServiceType;
use App\Models\ServiceTypeCategory;
use App\Models\ServiceCategorySymptomp;
use App\Models\Caze;


class CaseComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $currentArea = null, $currentServiceType = null, $currentServiceTypeCategory = null;
    public $types = null,$categories = null,$simptoms = null;

    public $case_id,$symptomp_id = null, $priority_case_id, $description;

    public $currentCase = null,$currentCaseFeedback = null,$currentCaseSupport = null, $currentCaseStatus = null;

    public $search_text;

    public $self_component = 'case';

    public function render()
    {
        $cases = Caze::where('user_contact_id',\Auth::user()->id)->orderBy('id','DESC')->paginate(5);
        $areas = ServiceArea::orderBy('name')->get();
        $priorities = CasePriority::get();

        if(!is_null($this->currentArea))
        {
            $this->types = ServiceType::where('service_area_id',$this->currentArea)->orderBy('name')->get();
        }
        if(!is_null($this->currentServiceType))
        {
            $this->categories = ServiceTypeCategory::where('service_type_id',$this->currentServiceType)->orderBy('name')->get();
        }
        if(!is_null($this->currentServiceTypeCategory))
        {
            $this->simptoms = ServiceCategorySymptomp::where('service_type_category_id',$this->currentServiceTypeCategory)->orderBy('name')->get();
        }

        return view('livewire.case-component',[
            'cases' => $cases,
            'areas' => $areas,
            'priorities' => $priorities,
        ]);
    }

    public function show($id)
    {
        $this->case_id = $id;
        $this->currentCase = Caze::find($id);
        $this->currentCaseStatus = $this->currentCase->status_id;
        $this->currentCaseSupport = $this->currentCase->user_support_id;
        $this->currentCaseFeedback = $this->currentCase->feedback;
        $this->emit('showCaseModal');
    }

    public function store ()
    {
        $this->validate([
            'currentArea' => 'required',
            'currentServiceType' => 'required',
            'currentServiceTypeCategory' => 'required',
            'symptomp_id' => 'required',
            'priority_case_id' => 'required',
            'description' => 'required',
        ],[
            'currentArea.required' => 'Campo obligatorio',
            'currentServiceType.required' => 'Campo obligatorio',
            'currentServiceTypeCategory.required' => 'Campo obligatorio',
            'symptomp_id.required' => 'Campo obligatorio',
            'priority_case_id.required' => 'Campo obligatorio',
            'description.required' => 'Campo obligatorio',
        ]);
        
        $lastCase = Caze::orderBy('id','DESC')->first();
        $explode = explode('NUM',$lastCase->num_case);

        $case = Caze::create([
            'num_case' => 'NUM'.($explode[1] + 1),
            'symptomp_id' => $this->symptomp_id,
            'priority_case_id' => $this->priority_case_id,
            'description' => $this->description
        ]);

        $this->emit('dismissCreateCaseModal');
        $this->emit('successNotification','La solicitud '.$case->num_case.' se creó con éxito.');
        $this->default();
    }

    public function update()
    {
        $auxCase = Caze::find($this->case_id);
        if(empty($this->currentCaseSupport))
            $auxCase->user_support_id = null;
        else 
            $auxCase->user_support_id = $this->currentCaseSupport;

        $auxCase->status_id = $this->currentCaseStatus;
        $auxCase->feedback = $this->currentCaseFeedback;
        $auxCase->save();
        $this->emit('successNotification','Información '.$auxCase->user_support_id.' actualizada...');
    }

    public function changeArea()
    {
        if(strlen($this->currentArea) <= 0){ 
            $this->currentServiceType = null;
            $this->currentServiceTypeCategory = null;
            $this->symptomp_id = null;
            $this->types = null;
            $this->categories = null;
            $this->simptoms = null;
        }
    }

    public function changeType()
    {
        if(strlen($this->currentArea) <= 0){ 
            $this->currentServiceTypeCategory = null;
            $this->symptomp_id = null;
            $this->categories = null;
            $this->simptoms = null;

        }
    }

    public function changeCategory()
    {
        if(strlen($this->currentArea) <= 0){ 
            $this->symptomp_id = null;
            $this->simptoms = null;

        }
    }

    public function default()
    {
        $this->currentServiceType = null;
        $this->currentServiceTypeCategory = null;
        $this->symptomp_id = null;

        $this->types = null;
        $this->categories = null;
        $this->simptoms = null;
    }
}
