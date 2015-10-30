<?php

namespace App\Models\Quiz\Question\Traits\Attribute;

use Illuminate\Support\Facades\Hash;
/**
 * summary
 */
trait QuestionAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute() {
        if (access()->can('edit-question'))
            return '<a href="'.route('admin.quiz.question.edit', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('crud.edit_button') . '"></i></a> ';
        return '';
    }    

    /**
     * @return string
     */
    public function getDeleteButtonAttribute() {
        if (access()->can('delete-question'))
            return '<a href="'.route('admin.quiz.question.destroy', $this->id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('crud.delete_button') . '"></i></a>';
        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute() {
        if (access()->can('restore-question'))
            return '<a href="'.route('admin.quiz.question.restore' , $this->id).'"  data-method="patch" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="Restorer"></i></a>';
        return '';
    }

     /**
     * @return string
     */
    public function getForceDeleteButtonAttribute() {
        if (access()->can('force-delete-question'))
            return '<a href="'.route('admin.quiz.question.forcedelete', $this->id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Supprimer difinitivement"></i></a>';
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