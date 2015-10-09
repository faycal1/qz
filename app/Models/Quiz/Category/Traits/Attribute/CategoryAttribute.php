<?php

namespace App\Models\Quiz\Category\Traits\Attribute;

use Illuminate\Support\Facades\Hash;
/**
 * summary
 */
trait CategoryAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute() {
        if (access()->can('edit-category'))
            return '<a href="'.route('admin.quiz.category.edit', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('crud.edit_button') . '"></i></a> ';
        return '';
    }

    //  public function getConfirmedButtonAttribute() {
    //     if (! $this->confirmed)
    //         if (access()->can('resend-user-confirmation-email'))
    //             return '<a href="'.route('admin.account.confirm.resend', $this->id).'" class="btn btn-xs btn-success"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Resend Confirmation E-mail"></i></a> ';
    //     return '';
    // }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute() {
        if (access()->can('delete-category'))
            return '<a href="'.route('admin.quiz.category.destroy', $this->id).'" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('crud.delete_button') . '"></i></a>';
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute() {
        return $this->getEditButtonAttribute().$this->getDeleteButtonAttribute();
    }
}