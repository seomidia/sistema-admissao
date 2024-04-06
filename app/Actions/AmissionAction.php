<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class AmissionAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Link';
    }

    public function getIcon()
    {
        return 'voyager-documentation';
    }

    public function getPolicy()
    {
        return 'delete';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right link',
        ];
    }

    public function getDefaultRoute()
    {
        return $this->data->id;
    }

}