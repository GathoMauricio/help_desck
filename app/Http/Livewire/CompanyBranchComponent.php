<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Company;
use App\Models\CompanyBranch;

class CompanyBranchComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $company_branch_id,$company_id=null,$company_id_aux=null,$name,$email,$phone,$address;

    public $search_text;

    public $self_component = 'company_branch';
    
    public function render()
    {
        if(request('id'))
        {
            $this->company_id = request('id');
        }
        
        if(!is_null($this->company_id))
        {
            $company = Company::findOrFail($this->company_id);

            if (strlen($this->search_text) > 0) {
                $branches = CompanyBranch::where('name', 'like', '%' . $this->search_text . '%')->where('company_id',$this->company_id)->orderBy('name')->paginate(5);
            }else{
                $branches = CompanyBranch::where('company_id',$this->company_id)->orderBy('name')->paginate(5);
            }
            return view('livewire.company-branch-component',[
                'company' => $company,
                'branches' => $branches
                ]);
        }else{
            if (strlen($this->search_text) > 0) {
                $branches = CompanyBranch::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5);
            }else{
                $branches = CompanyBranch::orderBy('name')->paginate(5);
            }
            return view('livewire.company-branch-component',[
                'branches' => $branches
                ]);
        }
        
    }

    public function store()
    { 
        if(is_null($this->company_id_aux)){
           
           $this->validate([
                //'company_id_aux' => 'required',
                'name' => 'required',
                'phone' => 'required|integer',
                'email' => 'required|email',
            ],[
                //'company_id_aux.required' => 'Este campo es requerido',
                'name.required' => 'Este campo es requerido',
                'email.required' => 'Este campo es requerido',
                'email.email' => 'No es un email válido',
                'phone.required' => 'Este campo es requerido',
                'phone.integer' => 'No es un número válido',
            ]);

            $branch = CompanyBranch::create([
                'company_id' => $this->company_id,
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
            ]);
        }
        else{
            $this->validate([
                'company_id_aux' => 'required',
                'name' => 'required',
                'phone' => 'required|integer',
                'email' => 'required|email',
            ],[
                'company_id_aux.required' => 'Este campo es requerido',
                'name.required' => 'Este campo es requerido',
                'email.required' => 'Este campo es requerido',
                'email.email' => 'No es un email válido',
                'phone.required' => 'Este campo es requerido',
                'phone.integer' => 'No es un número válido',
            ]);

            $branch = CompanyBranch::create([
                'company_id' => $this->company_id_aux,
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
            ]);
        } 
        
        

        $this->emit('dismissCreateCompanyBranchModal');
        $this->emit('successNotification','La sucursal '.$branch->name.' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $branch = CompanyBranch::find($id);
        $this->company_branch_id = $branch->id;
        $this->name = $branch->name;
        $this->phone =  $branch->phone;
        $this->email =  $branch->email;
        $this->address =  $branch->address;

        $this->emit('editCompanyBranch');
    }

    public function update()
    {
        $this->validate([
            //'company_id' => 'required',
            'name' => 'required',
            'phone' => 'required|integer',
            'email' => 'required|email',
        ],[
            //'company_id.required' => 'Este campo es requerido',
            'name.required' => 'Este campo es requerido',
            'email.required' => 'Este campo es requerido',
            'email.email' => 'No es un email válido',
            'phone.required' => 'Este campo es requerido',
            'phone.integer' => 'No es un número válido',
        ]);
        
        $branch = CompanyBranch::find($this->company_branch_id);
        $branch->name = $this->name;
        $branch->phone = $this->phone;
        $branch->email = $this->email;
        $branch->address = $this->address;
        $branch->save();

        $this->emit('dismissEditCompanyBranchModal');
        $this->emit('successNotification','La sucursal '.$branch->name.' se actualizó con éxito.');
        $this->default();

    }

    public function destroy($id)
    {
        $branch = CompanyBranch::find($id);
        $name = $branch->name;
        $branch->delete();
        $this->default();
        $this->emit('successNotification','La sucursal '.$name.' se eliminó con éxito.');
    }

    public function default()
    {
        $this->company_branch_id = "";
        $this->company_id_aux = null;
        $this->name = "";
        $this->phone = "";
        $this->email = "";
        $this->address = "";
    }
}
