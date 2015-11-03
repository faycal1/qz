<?php

namespace App\Models\Departement\Traits\Attribute;

/**
 * summary.
 */
trait DepartementAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->can('edit-departement')) {
            return '<a href="'.route('admin.departement.edit', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('crud.edit_button').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->can('delete-departement')) {
            return '<a href="'.route('admin.departement.destroy', $this->id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('crud.delete_button').'"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        if (access()->can('restore-departement')) {
            return '<a href="'.route('admin.departement.restore', $this->id).'"  data-method="patch" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="Restorer"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getForceDeleteButtonAttribute()
    {
        if (access()->can('force-delete-departement')) {
            return '<a href="'.route('admin.departement.forcedelete', $this->id).'"  data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Supprimer difinitivement"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute().$this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getActionDeletedButtonsAttribute()
    {
        return $this->getRestoreButtonAttribute().$this->getForceDeleteButtonAttribute();
    }
}
