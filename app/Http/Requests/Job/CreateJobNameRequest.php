<?php

namespace App\Http\Requests\job;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobNameRequest extends FormRequest
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
            'name_ar' => ['required', 'max:255', 'unique:job_names,name_ar,' . $this->job_name],
            'name_en' => ['required', 'max:255', 'unique:job_names,name_en,' . $this->job_name],

            // 'name_ar' => ['required', 'max:255', 'unique:job_names,name_ar,NULL,id,job_code_id,' . $this->job_code_id],
            // 'name_ar' => ['required', 'max:255', 'unique:job_names,name_en,NULL,id,job_code_id,' . $this->job_code_id],

            'job_code_id' => ['required', 'exists:job_codes,id'], // the job code that this grade belongs to
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
