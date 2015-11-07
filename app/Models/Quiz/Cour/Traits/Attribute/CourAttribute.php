<?php

namespace App\Models\Quiz\Cour\Traits\Attribute;

/**
 * summary.
 */
trait CourAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute($id)
    {
        if (access()->can('edit-cour')) {
            return '<a href="'.route('admin.quiz.cour.edit', $id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('crud.edit_button').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($id)
    {
        if (access()->can('delete-cour')) {
            return '<a href="'.route('admin.quiz.cour.destroy', $id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('crud.delete_button').'"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute($id)
    {
        if (access()->can('restore-cour')) {
            return '<a href="'.route('admin.quiz.cour.restore', $id).'"  data-method="patch" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="Restorer"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getForceDeleteButtonAttribute($id)
    {
        if (access()->can('force-delete-cour')) {
            return '<a href="'.route('admin.quiz.cour.forcedelete', $id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Supprimer difinitivement"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute($id)
    {
        return $this->getEditButtonAttribute($id).$this->getDeleteButtonAttribute($id);
    }

    /**
     * @return string
     */
    public function getActionDeletedButtonsAttribute($id)
    {
        return $this->getRestoreButtonAttribute($id).$this->getForceDeleteButtonAttribute($id);
    }
}
