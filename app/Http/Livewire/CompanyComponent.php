<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Company;
use App\Models\CompanyBranch;

class CompanyComponent extends Component
{
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy' => 'destroy'];

    use WithPagination;
    use WithFileUploads;

    public $company_id, $name, $description, $image;

    public $search_text;

    public function mount()
    {
        $this->search_text = "";
    }

    public function render()
    {
        if (strlen($this->search_text) > 0) {
            $companies = Company::where('name', 'like', '%' . $this->search_text . '%')->orderBy('name')->paginate(5);
        }else{
            $companies = Company::orderBy('name')->paginate(5);
        }
        return view('livewire.company-component',['companies' => $companies]);
    }

    public function show($id)
    {
        return redirect()->route("company_branches_by_id",$id);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Este campo es requerido'
        ]);

        $company = Company::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        if(!empty($this->image)){
            $imageName = 'CompanyImage['.$company->id.']'.\Str::random(60).'.png';
            $this->image->storeAs('company_images',$imageName);
            $company->image = $imageName;
            $company->save();
            $this->image = null;
        }

        $this->emit('dismissCreateCompanyModal');
        $this->emit('successNotification','La compañía '.$company->name.' se creó con éxito.');
        $this->default();
    }

    public function edit($id)
    {
        $this->company_id = $id;
        $company = Company::find($id);

        $this->name = $company->name;
        $this->description = $company->description;

        $this->emit('editCompany');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Este campo es requerido'
        ]);
        
        $company = Company::find($this->company_id);
        $company->name = $this->name;
        $company->description = $this->description;

        if(!empty($this->image)){
            $imageName = 'CompanyImage['.$company->id.']'.\Str::random(60).'.png';
            $this->image->storeAs('company_images',$imageName);
            $company->image = $imageName;
            $company->save();
            $this->image = null;
        }

        $this->emit('dismissEditCompanyModal');
        $this->emit('successNotification','La compañía '.$company->name.' se actualizó con éxito.');
        $this->default();
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        CompanyBranch::where('company_id',$id)->delete();
        $name = $company->name;
        $company->delete();
        $this->emit('successNotification','La compañía '.$name.' se eliminó con éxito.');
    }

    public function default()
    {
        $this->name = "";
        $this->description = "";
    }
}
