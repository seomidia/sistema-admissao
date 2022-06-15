<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class PrintAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Imprimir';
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
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return url('admissao/'.$this->data->id.'/imprimir');
    }

}