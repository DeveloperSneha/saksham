<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CandidateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'firstName'=>'required',
            'aadhar'=>'required',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|min:10|max:10',
            'idGender' =>'required',
            'maritalStatus'=>'required',
            'idDisabled'=>'required',
            'motherName' =>'required',
            'fatherName' =>'required',
            'dob'=>'required|date|before:today',
            'idSector'=>'required',          
            'idJobRole'=>'required',          
            'image' =>'mimes:jpg,png,jpeg|max:100',
            'idState'=>'required',
            'idDistrict'=>'required',            
            'idSubDistrict'=>'required',            
            'address'=>'required',            
            'tempState'=>'required',            
            'tempDistrict'=>'required',            
            'tempSubDistrict'=>'required',            
            'tempAddress'=>'required',            
            'pincode'=>'required',            
            'tempPincode'=>'required',  
            
        ];
        if($this->qualifications){
            foreach ($this->qualifications as $key => $value) {
                $rules['qualifications.' . $key . '.idQualification'] = 'required';
                $rules['qualifications.' . $key . '.idState'] = 'required';
                $rules['qualifications.' . $key . '.idUniversity'] = 'required';
                $rules['qualifications.' . $key . '.idDistrict'] = 'required';
                $rules['qualifications.' . $key . '.idMedium'] = 'required';
                $rules['qualifications.' . $key . '.passedYear'] = 'required';
                $rules['qualifications.' . $key . '.percentage'] = 'required';
            }
        }
        if($this->questions){
            foreach ($this->questions as $key => $value) {
                $rules['questions.' . $key ] = 'required';
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [
            'firstName.required' => 'Enter Your First Name.',
            'aadhar.required' => 'Enter Your Aadhaar Number.',
            'email.required' => 'Enter Your Email Id.',
            'dob.required' => 'Select Your date of Birth.',
            'fatherName.required' => 'Enter Your Father Name.',
            'motherName.required' => 'Enter Your Mother Name.',
            'idState.required' => 'Select Your Permanent State.',
            'idDistrict.required' => 'Select Your Permanent District.',
            'idSubDistrict.required' => 'Select Your Parmanent Sub District.',
            'pincode.required' => 'Enter Your Pin Code.',
            'address.required' => 'Enter Your Permanent Address.',
            'tempState.required' => 'Select Your Residential State.',
            'tempDistrict.required' => 'Select Your Residential District.',
            'tempSubDistrict.required' => 'Select Your Residential Sub District.',
            'tempPincode.required' => 'Enter Your Residential Pin Code.',
            'tempAddress.required' => 'Enter Your Residential Address.',
            'mobile.required' => 'Enter Your Contact Number.',
            'idGender.required' => 'Select Your Gender',
            'maritalStatus.required' => 'Select Your Marital Status.',
            'qualifications.*.idEducation.required' => 'Qualification must be selected.',
            'qualifications.*.idState.required' => 'Qualification State must be selected.',
            'qualifications.*.idUniversity.required' => 'Select University',
            'qualifications.*.idDistrict.required'=>'Qualification State must be selected',
            'qualifications.*.idMedium.required' => 'Select Medium',
            'qualifications.*.passedYear.required' => 'Select Passed Year',
            'qualifications.*.percentage.required' => 'Enter Percentage.',
            'idSector.required' => 'Select Sector',
            'idJobRole.required' => 'Select Job Role',
            'questions.*.required'=>'Please Answer the question',
            'image.max' => 'Image must not be greater than 100 KB',

        ];
        return $messages;
    }

}
