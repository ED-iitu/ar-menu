<?php
namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
class PickUpPointsAction extends AbstractAction
{
    public function getTitle()
    {
        return "Пункты самовывоза";
    }

    public function getIcon()
    {
        return "voyager-truck";
    }

    public function getAttributes()
    {
        // Action button class
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => 'margin-right:5px'
        ];
    }

    public function shouldActionDisplayOnDataType()
    {
        // show or hide the action button, in this case will show for posts model
        return $this->dataType->slug == 'shops';
    }

    public function getDefaultRoute()
    {
        return route('shop.pickup-points', $this->data->id);
    }
}
