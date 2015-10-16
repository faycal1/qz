<?php

namespace App\Models\Quiz\Cour\Traits\Attribute;

use Illuminate\Support\Facades\Hash;
/**
 * summary
 */
trait CourAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute() {
        if (access()->can('edit-cour'))
            return '<a href="'.route('admin.quiz.cour.edit', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('crud.edit_button') . '"></i></a> ';
        return '';
    }    

    /**
     * @return string
     */
    public function getDeleteButtonAttribute() {
        if (access()->can('delete-cour'))
            return '<a href="'.route('admin.quiz.cour.destroy', $this->id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('crud.delete_button') . '"></i></a>';
        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute() {
        if (access()->can('restore-cour'))
            return '<a href="'.route('admin.quiz.cour.restore' , $this->id).'"  data-method="patch" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="Restorer"></i></a>';
        return '';
    }

     /**
     * @return string
     */
    public function getForceDeleteButtonAttribute() {
        if (access()->can('force-delete-cour'))
            return '<a href="'.route('admin.quiz.cour.forcedelete', $this->id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Supprimer difinitivement"></i></a>';
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute() {
        return $this->getEditButtonAttribute().$this->getDeleteButtonAttribute();
    }


     /**
     * @return string
     */
    public function getActionDeletedButtonsAttribute() {
        return $this->getRestoreButtonAttribute().$this->getForceDeleteButtonAttribute();
    }
}