<?php

namespace App\Http\Requests\User;

use App\Rules\UserActive;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => ['required', 'max:255'],
            'name_en' => ['required', 'max:255'],
            'username' => 'required', 'max:255', 'unique:users,username,'.\Auth::id(),
            'email' => 'required', 'max:255', 'email', 'unique:users,email,'.\Auth::id(),
         //   'password' => ['required'],

            'manager_id' => ['nullable', 'exists:users,id', new UserActive], // Manager user of departmet
            'sector_id' => ['nullable', 'exists:sectors,id'], // the sector that department belongs to
            'department_id' => ['nullable', 'exists:departments,id'], // the sector that department belongs to

            'job_name_id' => ['required', 'exists:job_names,id'], // the job name that Employee belongs to
            'job_grade_id' => ['required', 'exists:job_grades,id'], // the job grade that Employee belongs to
            'position_ar' => ['required', 'max:255'],
            'position_en' => ['required', 'max:255'],
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        Toastr()->error(
            trans('site.validation_error'),
            trans("site.Sorry"),
            [
                "closeButton" => true,
                "progressBar" => true,
                "positionClass" => app()->getlocale() == 'en' ? "toast-top-right" : "toast-top-left",
                "timeOut" => "3000",
                "extendedTimeOut" => "3000",
            ]
        );
        $url = $this->redirector->getUrlGenerator();

        if ($this->redirect) {
            return $url->to($this->redirect);
        } elseif ($this->redirectRoute) {
            return $url->route($this->redirectRoute);
        } elseif ($this->redirectAction) {
            return $url->action($this->redirectAction);
        }

        return $url->previous();
    }
}
