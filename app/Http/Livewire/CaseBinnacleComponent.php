<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CaseBinnacle;

class CaseBinnacleComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $self_component = 'case_binnacle';
    public $search_text;

    public 
    $binnacle_id,
    $case_id,
    $case_binnacle_description;

    public function render()
    {
        $binnacles = CaseBinnacle::where('case_id',$this->case_id)->paginate(5);
        return view('livewire.case-binnacle-component',['binnacles'=>$binnacles]);
    }

    public function store()
    {
        $this->validate([
            'case_binnacle_description' => 'required'
        ],[
            'case_binnacle_description.required' => 'Este campo es obligatorio.'
        ]);
        $binnacle = CaseBinnacle::create([
            'case_id' => $this->case_id,
            'description' => $this->case_binnacle_description
        ]);
        $this->case_binnacle_description = null;
        $this->emit('dissmisCreateCaseBinnacle');
        $this->emit('successNotification','La bitácora '.$binnacle->description.' ha sido creada.');
    }

    public function edit($id){
        $binnacle = CaseBinnacle::find($id);
        $this->binnacle_id = $binnacle->id;
        $this->case_binnacle_description = $binnacle->description;
        $this->emit('editCaseBinnacle');
    }

    public function update(){
        $this->validate([
            'case_binnacle_description' => 'required'
        ],[
            'case_binnacle_description.required' => 'Este campo es obligatorio.'
        ]);
        $binnacle = CaseBinnacle::find($this->binnacle_id);
        $binnacle->description = $this->case_binnacle_description;
        $binnacle->save();
        $this->case_binnacle_description = null;
        $this->emit('successNotification','La bitácora '.$binnacle->description.' ha sido actualizada.');
        $this->emit('dissmisEditCaseBinnacle');
    }

    public function destroy($id){
        $binnacle = CaseBinnacle::find($id);
        $binnacle->delete();
        $this->emit('successNotification','La bitácora  ha sido eliminada.');
    }
}
