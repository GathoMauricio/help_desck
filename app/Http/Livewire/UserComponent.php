<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserComponent extends Component
{
    use WithPagination;

    protected $listeners = ['destroy' => 'destroy'];

    public $user_id, $name, $middle_name, $last_name, $email,$search_text;
    public $view = 'create';

    public function render()
    {
        
        if(strlen($this->search_text) > 0)
        {
            return view('livewire.user-component',[
                'usuarios' => User::where('name','like','%'.$this->search_text.'%')->orderBy('name')->paginate(5)
            ]);
        }else{
            return view('livewire.user-component',[
                'usuarios' => User::orderBy('name')->paginate(5)
            ]);
        }
        
    }

    public function store(){ 
        $this->validate([
            'name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
        ]);
        User::create([
            'name' => $this->name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ]);
        $this->default();
    }

    public function edit($id)
    {
        $this->user_id = $id;

        $user = User::find($id);
        $this->name = $user->name; 
        $this->middle_name = $user->middle_name; 
        $this->last_name = $user->last_name; 
        $this->email= $user->email;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($this->user_id);
        $user->name = $this->name; 
        $user->middle_name = $this->middle_name;  
        $user->last_name = $this->last_name; 
        $user->email = $this->email; 
        $user->save();
        $this->emit('msg' , "Registro ".$user->name."  actualizado");
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
    }

    public function default(){
        $this->name = ""; 
        $this->middle_name = ""; 
        $this->last_name = ""; 
        $this->email= "";
        $this->view = "create";
    }
}
