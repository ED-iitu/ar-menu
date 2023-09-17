<?php
namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
class DetailedOrderAction extends AbstractAction
{
    public function getTitle()
    {
        return "Детали заказа";
    }

    public function getIcon()
    {
        return "voyager-bag";
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
        return $this->dataType->slug == 'orders';
    }

    public function getDefaultRoute()
    {
        return route('order.details', $this->data->id);
    }
}
