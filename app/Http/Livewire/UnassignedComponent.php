<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Caze;

class UnassignedComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['takeCase' => 'takeCase'];

    use WithPagination;
    use WithFileUploads;

    public $self_component = 'case';

    public function render()
    {
        $cases = Caze::where('user_support_id',NULL)->paginate(5);
        return view('livewire.unassigned-component',['cases' => $cases]);
    }

    public function takeCase($case_id)
    {
        $case = Caze::findOrFail($case_id);
        $case->user_support_id = \Auth::user()->id;
        $case->status_id = 2;
        $case->save();
        $this->emit('successNotification',"El caso se ha agregado a su lista en proceso");


        $message = "El estatus del caso ".$case->description. " ha cambiado a: En progreso";
        sendPusher($case->contact['id'],'message',$message);
    }
}
