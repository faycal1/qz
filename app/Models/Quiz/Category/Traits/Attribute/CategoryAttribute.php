<?php

namespace App\Models\Quiz\Category\Traits\Attribute;

/**
 * summary.
 */
trait CategoryAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute($id)
    {
        if (access()->can('edit-category')) {
            return '<a href="'.route('admin.quiz.category.edit', $id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('crud.edit_button').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($id)
    {
        if (access()->can('delete-category')) {
            return '<a href="'.route('admin.quiz.category.destroy', $id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('crud.delete_button').'"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute($id)
    {
        if (access()->can('restore-category')) {
            return '<a href="'.route('admin.quiz.category.restore', $id).'"  data-method="patch" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="Restorer"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getForceDeleteButtonAttribute($id)
    {
        if (access()->can('force-delete-category')) {
            return '<a href="'.route('admin.quiz.category.forcedelete', $id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Supprimer difinitivement"></i></a>';
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
