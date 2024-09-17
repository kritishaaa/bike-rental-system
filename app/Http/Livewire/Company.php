<?php

namespace App\Http\Livewire;

use App\Models\Company as ModelsCompany;
use Livewire\Component;
use Livewire\Request;

use function PHPUnit\Framework\isNull;

class Company extends Component
{
    public $toggle="hide";
    public $name,$address,$phone_number;

    public function toggleeditcompany(){
       
        if( $this->toggle=='hide'){
             $this->toggle='show';
        }elseif( $this->toggle='show'){
             $this->toggle='hide';
        }

    }

    public function mount(){
        
        $data=ModelsCompany::first();
     

        
        if(isset($data)){
         $this->name=$data->name;
        $this->address=$data->address;
        $this->phone_number=$data->phonenumber;
        }

        

       
    }

    public function rules(){
        return [
            'name'=>'required|min:3',
            'address'=>'required|min:3',
            'phone_number'=>'required|numeric'
        ];
    }

     public function submit(){
       
       $this->validate();

       
     $data=[
        'name'=>$this->name,
        'address'=>$this->address,
        'phonenumber'=>$this->phone_number,
        'user_id'=>auth()->user()->id
     ];

     $company=ModelsCompany::first();

  if(!isset($company)){
             ModelsCompany::create($data);
             session()->flash('success','Company is successfully Setup');
        }else{
            ModelsCompany::where('user_id','=',$data['user_id'])->update($data);
             session()->flash('success','Company is successfully Updated');
        }

      

       $this->reset(['name','address','phone_number']);

      

       $this->mount();
       $this->toggleeditcompany();

    }
    public function updated($field){
        $this->validateOnly($field);
    }
    public function render()
    {
        return view('livewire.company');
    }
}
