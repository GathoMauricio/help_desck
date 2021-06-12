<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\UserRol;
use App\Models\Company;
use App\Models\CompanyBranch;

class UserComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'edit' => 'edit',
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

    public $branches = null, $search_text;

    public $self_component = 'user';

    public function mount()
    {
        $this->search_text = "";
    }
    
    public function render()
    {

        $roles = UserRol::all();
        $companies = Company::orderBy('name')->get();

        if (!empty($this->company_id)) {
            $this->branches = CompanyBranch::where('company_id', $this->company_id)->orderBy('name')->get();
        }

        if (strlen($this->search_text) > 0) {
            return view('livewire.user-component', [
                'usuarios' => User::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5),
                'roles' => $roles,
                'companies' => $companies,
            ]);
        } else {
            return view('livewire.user-component', [
                'usuarios' => User::orderBy('name')->paginate(5),
                'roles' => $roles,
                'companies' => $companies,
            ]);
        }
    }
    public function create()
    {
        $this->emit('createUser');
    }
    public function store()
    {

        $this->validate(
            [
                'user_rol_id' => 'required',
                'company_id' => 'required',
                'company_branch_id' => 'required',
                'name' => 'required',
                'middle_name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6',
            ],
            [
                'user_rol_id.required' => 'Este campo es requerido',
                'company_id.required' => 'Este campo es requerido',
                'company_branch_id.required' => 'Este campo es requerido',
                'name.required' => 'Este campo es requerido',
                'middle_name.required' => 'Este campo es requerido',
                'email.required' => 'Este campo es requerido',
                'email.email' => 'Este campo no tiene formato de email',
                'password.required' => 'Este campo es requerido',
                'password_confirmation.required' => 'Este campo es requerido',
            ]
        );

        $user = User::create([
            'user_rol_id' => $this->user_rol_id,
            'company_branch_id' => $this->company_branch_id,
            'name' => $this->name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'email' => $this->email,
            'address' => $this->address,
            'password' => $this->password,
        ]);

        if(!empty($this->image)){
            $imageName = 'UserImage['.$user->id.']'.\Str::random(60).'.png';
            $this->image->storeAs('user_images',$imageName);
            $user->image = $imageName;
            $user->save();
            $this->image = null;
        }

        $this->emit('dismissCreateUserModal');
        $this->emit('successNotification','El usuario '.$user->name.' '.$user->middle_name.' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $this->user_id = $id;
        $user = User::find($id);

        $this->user_rol_id = $user->user_rol_id;
        $this->company_id = $user->branch->company['id'];
        $this->company_branch_id = $user->company_branch_id;
        $this->name = $user->name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->emergency_phone = $user->emergency_phone;
        $this->email = $user->email;
        $this->address = $user->address;

        $this->emit('editUser');
    }

    public function update()
    {
        $this->validate(
            [
                'user_rol_id' => 'required',
                'company_id' => 'required',
                'company_branch_id' => 'required',
                'name' => 'required',
                'middle_name' => 'required',
                'email' => 'required|email',
            ],
            [
                'user_rol_id.required' => 'Este campo es requerido',
                'company_id.required' => 'Este campo es requerido',
                'company_branch_id.required' => 'Este campo es requerido',
                'name.required' => 'Este campo es requerido',
                'middle_name.required' => 'Este campo es requerido',
                'email.required' => 'Este campo es requerido',
                'email.email' => 'Este campo no tiene formato de email',
            ]
        );


        $user = User::find($this->user_id);
        $user->user_rol_id = $this->user_rol_id;
        $user->company_branch_id = $this->company_branch_id;
        $user->name = $this->name;
        $user->middle_name = $this->middle_name;
        $user->last_name = $this->last_name;
        $user->phone = $this->phone;
        $user->emergency_phone = $this->emergency_phone;
        $user->email = $this->email;
        $user->address = $this->address;
        if(!empty($this->image)){
            $imageName = 'UserImage['.$user->id.']'.\Str::random(60).'.png';
            $this->image->storeAs('user_images',$imageName);
            $user->image = $imageName;
            $this->image = null;
        }
        $user->save();
        
        $this->emit('dismissEditUserModal');
        $this->emit('successNotification','El usuario '.$user->name.' '.$user->middle_name.' se actualizó con éxito.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $name = $user->name.' '.$user->middle_name;
        $user->delete();
        $this->emit('successNotification','El usuario '.$name.' se eliminó con éxito.');
    }

    public function default()
    {
        $this->name = "";
        $this->middle_name = "";
        $this->last_name = "";
        $this->email = "";
    }
}
