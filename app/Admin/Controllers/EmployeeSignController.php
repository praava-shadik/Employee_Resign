<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeSign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class EmployeeSignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmployeeSign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeSign());

        $grid->column('id', __('Id'));
        $grid->emptable()->emp_id('Employee_ID');
        $grid->emptable()->emp_name('Employee_Name');
        $grid->column('cd', __('Cd'));
        $grid->column('employee_sign', __('Employee sign'));

        $grid->model()->orderBy('id', 'desc');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(EmployeeSign::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('employee_sign', __('Employee sign'));
        $show->field('cb', __('Cb'));
        $show->field('cd', __('Cd'));
        $show->field('ub', __('Ub'));
        $show->field('ud', __('Ud'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmployeeSign());

        
        $Emp = \App\Models\Employee::all()->map(function ($emp) {
            return [
                'id' => $emp->id,
                'label' => "{$emp->emp_id} - {$emp->emp_name}",
            ];
        })->pluck('label', 'id')->toArray();
        $form->select('employee_id', __('Employee ID & Name'))->options($Emp);

       $form->image('employee_sign', 'Image');
       
       $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
       $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

       $form->saved(function (Form $form) {
            $id=$form->model()->id;
            $employeeSign=EmployeeSign::find($id);
            
            $imagePath = public_path('upload/' . $employeeSign->employee_sign);
            $imageData = 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));
            $employeeSign->employee_sign = $imageData;
            $employeeSign->save();
            unlink($imagePath);
        });
       
       return $form;
    }
    
}
