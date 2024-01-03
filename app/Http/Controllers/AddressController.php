<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Auth\Access\AuthorizationException;

class AddressController extends Controller
{

    public function destroy(Address $address){
        try{
            $this->authorize('delete', $address);
        }catch(AuthorizationException $e){
            return back()->with('message', 'You are not allowed to delete this');
        }
        
        if($address->purchases()->exists()){
            $address->delete();   
        }
        else{
            $address->forceDelete();
        }

        return back()->with('message', 'Address has been deleted!');
    }
    public function update(Address $address){
        try{
            $this->authorize('update', $address);
        } catch(AuthorizationException $e){
            return back()->with('message', 'You are not allowed to update this');
        }
        

        $formFields = request()->validate([
            'label' => 'required',
            'street' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:50'],
            'postal_code' => ['required', 'string', 'max:15'],
        ]);

        $address->update($formFields);

        return back()->with('message', 'Address has been updated!');
    }
    public function store(){
        $formFields = request()->validate([
            'label' => 'required',
            'street' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:50'],
            'postal_code' => ['required', 'string', 'max:15'],
        ]);
        $formFields['user_id'] = auth()->id();

        Address::create($formFields);

        return back()->with('message', 'Address has been added!');
    }
}

