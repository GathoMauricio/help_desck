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
use App\Models\SymptomSuggestion;
use App\Models\Caze;
use App\Models\User;
use App\Models\CaseBinnacle;
use App\Models\BinnacleImage;

class CaseComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy','destroyBinnacle' => 'destroyBinnacle'];

    use WithPagination;
    use WithFileUploads;

    public $currentArea = null, $currentServiceType = null, $currentServiceTypeCategory = null;
    public $types = null,$categories = null,$simptoms = null, $suggestions = null, $cb_suggest;

    public $case_id,$symptomp_id = null, $priority_case_id, $description;

    public $currentCase = null,$currentCaseFeedback = null,$currentCaseSupport = null, $currentCaseStatus = null;

    public $search_text;

    public $self_component = 'case';

    public $status_case;

    #Propiedades para manipular bítácoras
    public
        $curent_case_id,
        $current_binnacle_id,
        $binnacles,
        $case_binnacle_description
        ;
    #propiedades para manipular imagenes de bitácora
    public
        $binnacle_image,
        $binnacle_image_description;

    public function render()
    {
        if(!is_null($this->status_case))
        {
            if(\Auth::user()->user_rol_id == 1)
            $cases = Caze::where('status_id',$this->status_case)->orderBy('id','DESC')->paginate(5);
        }else{
            if(\Auth::user()->user_rol_id == 1)
            $cases = Caze::orderBy('id','DESC')->paginate(5);
        }

        if(!is_null($this->status_case))
        {
            if(\Auth::user()->user_rol_id == 2)
            $cases = Caze::where('status_id',$this->status_case)->where('user_support_id',\Auth::user()->id)->orderBy('id','DESC')->paginate(5);
        }else{
            if(\Auth::user()->user_rol_id == 2)
            $cases = Caze::where('user_support_id',\Auth::user()->id)->orderBy('id','DESC')->paginate(5);
        }

        if(!is_null($this->status_case))
        {
            if(\Auth::user()->user_rol_id == 3)
            $cases = Caze::where('status_id',$this->status_case)->where('user_contact_id',\Auth::user()->id)->orderBy('id','DESC')->paginate(5);
        }else{
            if(\Auth::user()->user_rol_id == 3)
            $cases = Caze::where('user_contact_id',\Auth::user()->id)->orderBy('id','DESC')->paginate(5);
        }




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

    public function createBinnacleImage($id)
    {
        $this->current_binnacle_id = $id;
        $this->emit('createBinnacleImageModal');
    }
    public function storeBinnacleImage()
    {
        $this->validate([
            'binnacle_image' => 'required',
            'binnacle_image_description' => 'required',
        ],[
            'binnacle_image.required' => 'Este campo es obligatorio',
            'binnacle_image_description.required' =>  'Este campo es obligatorio',
        ]);
        //BinnacleImage
        $binnacle = BinnacleImage::create([
            'binnacle_id' => $this->current_binnacle_id,
            'description' => $this->binnacle_image_description
        ]);
        $imageName = 'BinnacleImage['.$binnacle->id.']'.\Str::random(60).'.png';
        $this->binnacle_image->storeAs('binnacle_images',$imageName);
        $binnacle->image = $imageName;
        $binnacle->save();
        $this->current_binnacle_id = null;
        $this->binnacle_image = null;
        $this->binnacle_image_description = null;
        $this->emit('dissmisCreateBinnacleImage');
        $this->emit('successNotification','La imagen '.$binnacle->description,' se almacenó con éxito');
    }

    public function showBinnacles($id){
        $this->binnacles = CaseBinnacle::where('case_id',$id)->get();
        $this->curent_case_id = $id;
        $this->emit('showCaseBinnacles');
    }

    public function storeBinnacle()
    {
        $this->validate([
            'case_binnacle_description' => 'required'
        ],[
            'case_binnacle_description.required' => 'Este campo es obligatorio.'
        ]);
        $binnacle = CaseBinnacle::create([
            'case_id' => $this->curent_case_id,
            'description' => $this->case_binnacle_description
        ]);
        $this->binnacles = CaseBinnacle::where('case_id',$this->curent_case_id)->get();
        $this->case_binnacle_description = null;
        $this->emit('dissmisCreateCaseBinnacle');
        $this->emit('successNotification','La bitácora '.$binnacle->description.' ha sido creada.');
    }

    public function editBinnacle($id)
    {
        $binnacle = CaseBinnacle::find($id);
        $this->current_binnacle_id = $binnacle->id;
        $this->case_binnacle_description = $binnacle->description;
        $this->emit('editCaseBinnacle');
    }

    public function updateBinnacle()
    {
        $this->validate([
            'case_binnacle_description' => 'required'
        ],[
            'case_binnacle_description.required' => 'Este campo es obligatorio.'
        ]);
        $binnacle = CaseBinnacle::find($this->current_binnacle_id);
        $binnacle->description = $this->case_binnacle_description;
        $binnacle->save();
        $this->binnacles = CaseBinnacle::where('case_id',$this->curent_case_id)->get();
        $this->case_binnacle_description = null;
        $this->emit('successNotification','La bitácora '.$binnacle->description.' ha sido actualizada.');
        $this->emit('dissmisEditCaseBinnacle');
    }

    public function destroyBinnacle($id)
    {
        $binnacle = CaseBinnacle::find($id);
        $binnacle->delete();
        $this->binnacles = CaseBinnacle::where('case_id',$this->curent_case_id)->get();
        $this->emit('successNotification','La bitácora  ha sido eliminada.');
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
            'cb_suggest' => 'required|integer|min:1',
        ]
        ,[
            'currentArea.required' => 'Campo obligatorio',
            'currentServiceType.required' => 'Campo obligatorio',
            'currentServiceTypeCategory.required' => 'Campo obligatorio',
            'symptomp_id.required' => 'Campo obligatorio',
            'priority_case_id.required' => 'Campo obligatorio',
            'description.required' => 'Campo obligatorio',
            'cb_suggest.required' => "Por favor confirme que ha leido las sugerencias",
            'cb_suggest.integer' => "Por favor confirme que ha leido las sugerencias",
            'cb_suggest.min' => "Por favor confirme que ha leido las sugerencias",
        ]);

        $lastCase = Caze::orderBy('id','DESC')->first();
        $explode = explode('-',$lastCase->num_case);

        $case = Caze::create([
            'num_case' => 'C-'.($explode[1] + 1),
            'symptomp_id' => $this->symptomp_id,
            'priority_case_id' => $this->priority_case_id,
            'description' => $this->description
        ]);

        $supports = User::where(function($q){
            $q->where('user_rol_id', 1);
            $q->orWhere('user_rol_id', 2);
        })->get();
        foreach ($supports as $support) {
            sendPusher($support->id, 'message', 'Se han agregado nuevos casos en espera de asignación.');
            sendFcm($support->fcm_token, "Nuevos casos", 'Se han agregado nuevos casos en espera de asignación.', ['case_id' => $case->id]);
        }

        $this->emit('dismissCreateCaseModal');
        $this->emit('successNotification','La solicitud '.$case->num_case.' se creó con éxito.');
        $this->default();

        $supports = User::where('user_rol_id',2)->get();
        foreach($supports as $support)
        {
            sendPusher($support->id,'message','Se han agregado nuevos casos en espera de asignación.');
            sendFcm($support->fcm_token,"Nuevos casos", 'Se han agregado nuevos casos en espera de asignación.',['case_id' => $case->id]);
        }
    }

    public function update()
    {
        $auxCase = Caze::find($this->case_id);
        $soporte_actual = $auxCase->user_support_id;
        if(empty($this->currentCaseSupport))
            $auxCase->user_support_id = null;
        else
        {
            $auxCase->user_support_id = $this->currentCaseSupport;

            if($this->currentCaseSupport != $soporte_actual)
            {
                $body = $auxCase->support['name'].' '.$auxCase->support['middle_name'].' a sido asignado a su caso '.$auxCase->num_case;
                sendFcm($auxCase->contact['fcm_token'],"Caso en progreso", $body,['tipo' => 'caso_asignado','case_id' => $auxCase->id,'body'=>$body]);
            }

        }


        if($auxCase->status_id != $this->currentCaseStatus)
        {
            switch ($this->currentCaseStatus) {
                case 1:
                    $statusMsg = "Pendiente";
                break;
                case 2:
                    $statusMsg = "En progreso";
                break;
                case 3:
                    $statusMsg = "Finalizado";
                break;
            }

            //Enviar notificación de cambio de estatus
            $body = "El caso ".$auxCase->num_case." ha sido marcado como ".$statusMsg;
            sendPusher($auxCase->contact['id'],'message',$body);
            sendFcm($auxCase->contact['fcm_token'],"Caso ".$statusMsg, $body,['tipo' => 'caso_asignado','case_id' => $auxCase->id,'body'=>$body]);
            $this->emit('successNotification',$body);
        }

        $auxCase->status_id = $this->currentCaseStatus;
        $auxCase->feedback = $this->currentCaseFeedback;
        $auxCase->save();
        $this->emit('successNotification','Información actualizada...');
    }

    public function destroy($id)
    {
        $auxCase = Caze::find($id);
        //$name = $auxCase->description;
        if($auxCase) $auxCase->delete();
        $this->emit('successNotification', 'El caso se eliminó con éxito.');
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

    public function changeSymptom()
    {
        if(strlen($this->symptomp_id) > 0){
            $this->suggestions = SymptomSuggestion::where('symptom_id', $this->symptomp_id)->get();
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
