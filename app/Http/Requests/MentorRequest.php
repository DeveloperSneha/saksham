<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest {

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
        $id = $this->idMentor;
        if($id){
            $rules = [
                'firstName'=>'required',
                'email' => 'required|string|email|max:255|unique:mentors,email,'.$id.',idMentor',
                'mobile' => 'required|min:10|max:10|unique:mentors,mobile,'.$id.',idMentor',
                'idGender'=>'required',
                'dob'=>'required',
                'idJobRole'=>'required',
                'idExperience'=>'required',
                'idQualification'=>'required',
                'about'=>'required',
                'headline'=>'required',
                'languages'=>'required',
                'photo' =>'mimes:jpg,png,jpeg|max:100',
            ];  
        }else{
            $rules = [
                'firstName'=>'required',
                'email' => 'required|string|email|max:255|unique:mentors',
                'mobile' => 'required|min:10|max:10|unique:mentors',
                'password' => 'required|string|min:6|confirmed',
                'idGender'=>'required',
                'dob'=>'required',
                'idJobRole'=>'required',
                'idExperience'=>'required',
                'about'=>'required',
                'headline'=>'required',
                'languages'=>'required',
                'photo' =>'mimes:jpg,png,jpeg|max:100',
            ]; 
        }
        return $rules;
    }

    public function messages() {
        $messages = [
            'firstName.required'=>'First Name is mandatory',
            'email.required'=>'Email is mandatory',
            'mobile.required'=>'Contact Number is mandatory',
            'idGender.required'=>'Gender must be selected',
            'dob.required'=>'Date of birth is mandatory',
            'idJobRole.required'=>'Job Role is mandatory',
            'about.required'=>'Job Role is mandatory',
            'headline.required'=>'Job Role is mandatory',
            'languages.required'=>'Languages Known must be selected',
            'idExperience.required'=>'Experience must be selected',
            'idQualification.required'=>'Higher Qualification must be selected',
            'photo.max' => 'Photo must not be greater than 100 KB',
            ];
        return $messages;
    }
}
