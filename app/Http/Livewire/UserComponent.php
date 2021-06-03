<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\UserRol;
use App\Models\Company;
use App\Models\CompanyBranch;

class UserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'destroy' => 'destroy'
    ];

    public 
    $user_id, 
    $user_rol_id,
    $company_id,
    $company_branch_id,
    $name, 
    $middle_name, 
    $last_name, 
    $phone,
    $emergency_phone,
    $email,
    $address,
    $image,
    $password,
    $password_confirmation;
    
    public $branches = null,$search_text;

    public function render()
    {
        
        $roles = UserRol::all();
        $companies = Company::orderBy('name')->get();
        
        if(!empty($this->company_id))
        {
            $this->branches = CompanyBranch::where('company_id', $this->company_id)->get();
        }
        
        if(strlen($this->search_text) > 0)
        {
            return view('livewire.user-component',[
                'usuarios' => User::where('name','like','%'.$this->search_text.'%')->orderBy('name')->paginate(5),
                'roles' => $roles,
                'companies' => $companies,
            ]);
        }else{
            return view('livewire.user-component',[
                'usuarios' => User::orderBy('name')->paginate(5),
                'roles' => $roles,
                'companies' => $companies,
            ]);
        }
        
    }
    public function create(){
        $this->emit('createUser');
    }
    public function store(){ 
        
        $this->validate([
            'user_rol_id' => 'required',
            'company_id' => 'required',
            'company_branch_id' => 'required',
            'name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
        ],
[
            'user_rol_id.required' => 'Este campo es requerido',
            'company_id.required' => 'Este campo es requerido',
            'company_branch_id.required' => 'Este campo es requerido',
            'name.required' => 'Este campo es requerido',
            'middle_name.required' => 'Este campo es requerido',
            'email.required' => 'Este campo es requerido',
            'password.required' => 'Este campo es requerido',
            'password_confirmation.required' => 'Este campo es requerido',
        ]);
        
        User::create([
            'user_rol_id' => $this->user_rol_id,
            'company_branch_id' => $this->company_branch_id,
            'name' => $this->name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $this->emit('dismissCreateUserModal');
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
    }
}
