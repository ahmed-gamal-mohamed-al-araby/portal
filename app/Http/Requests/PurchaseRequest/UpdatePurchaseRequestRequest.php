<?php

namespace App\Http\Requests\PurchaseRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequestRequest extends FormRequest
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
            'sector_id' => ['required', 'exists:sectors,id'], // the sector that purchase order belongs to
            'group_id' => ['required', 'exists:groups,id'],  // the group that purchase order belongs to
            'department_id' => ['nullable', 'exists:departments,id'],  // the department that purchase order belongs to
            'project_id' => ['nullable', 'exists:projects,id'],  // the project that purchase order belongs to
            'site_id' => ['nullable', 'exists:sites,id'],  // the site that purchase order belongs to

            'family_names_id' => ['required', 'array', 'min:1'], // item required family names for purchase order
            'family_names_id.*' => ['required'],

            'quantities' => ['required', 'array', 'min:1'], // item required quantity for purchase order
            'quantities.*' => ['required', 'numeric'],

            'stock_quantities' => ['required', 'array', 'min:1'], // item stock quantity for purchase order
            'stock_quantities.*' => ['required', 'numeric'],

            'actual_quantities' => ['required', 'array', 'min:1'], // item actual required quantity for purchase order
            'actual_quantities.*' => ['required', 'numeric'],

            'units_id' => ['required', 'array', 'min:1'], // item unit for purchase order
            'units_id.*' => ['required', 'exists:units,id'],

            'specifications' => ['required', 'array', 'min:1'], // item specification for purchase order
            'specifications.*' => ['required', 'string'],

            'comments' => ['required', 'array', 'min:1'], // item comment for purchase order
            'comments.*' => ['nullable', 'string'],

            'priorities' => ['required', 'array', 'min:1'], // item priority for purchase order
            'priorities.*' => ['required', 'string', 'in:L,M,H'], // 'L: Low, M: Medium, H: High'
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
