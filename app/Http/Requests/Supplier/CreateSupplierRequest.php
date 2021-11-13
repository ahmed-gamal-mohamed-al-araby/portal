<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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
            'name_ar' => ['required', 'max:255', 'unique:suppliers,name_ar,' . $this->supplier],
            'name_en' => ['required', 'max:255', 'unique:suppliers,name_en,' . $this->supplier],
            'country_id' => ['required', 'exists:countries,id'],
            'governorate_id' => ['required', 'exists:governorates,id'],
            'city_ar' => ['required', 'max:75'],
            'city_en' => ['required', 'max:75'],
            'street_ar' => ['required', 'max:100'],
            'street_en' => ['required', 'max:100'],
            'building_no' => ['required', 'max:4'],
            'phone' => ['required', 'min:4', 'max:16'],
            'mobile' => ['nullable', 'min:4', 'max:16'],
            'email' => ['nullable', 'max:255', 'unique:suppliers,email,' . $this->supplier],
            'fax' => ['nullable', 'max:25'],
            'gmap_url' => ['nullable', 'url', 'max:520'],
            'website_url' => ['nullable', 'url', 'max:520'],
            'tax_id_number' => ['required', 'max:11', 'unique:suppliers,tax_id_number,' . $this->supplier],
            'tax_id_number_file' => ['required'],
            'commercial_registeration_number' => ['required', 'min:4', 'max:7'],
            'commercial_registeration_number_file' => ['required'],
            'value_add_registeration_number' => ['nullable', 'max:11', 'unique:suppliers,value_add_registeration_number,' . $this->supplier],

            'persons' => ['required', 'array', 'min:1'],
            'persons.*.name' => ['required', 'max:255'],
            'persons.*.job' => ['required', 'max:255'],
            'persons.*.mobile' => ['required', 'min:4', 'max:16'],
            'persons.*.whatsapp' => ['nullable', 'min:4', 'max:16'],
            'persons.*.email' => ['nullable', 'email', 'max:255'],
            'familyNames' => ['required', 'array', 'min:1'],
            'familyNames.*' => ['required', 'string', 'distinct'],
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
