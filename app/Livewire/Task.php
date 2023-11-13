<?php

namespace App\Livewire;

use App\Models\Task as Tassk;
use Livewire\Component;

class Task extends Component
{

    public $name, $status, $tasks, $taskId, $updateTask = false, $addTask = false;
 
    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteTaskListner'=>'deleteTask'
    ];
 
    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required',
    ];
 
    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields()
    {
        $this->name = '';
    }

    public function showTaskForm()
    {
        $this->resetFields();
        $this->addTask = true;
        $this->updateTask = false;
    }

    public function storeTask()
    {
        $this->validate();
        try {
            Tassk::create([
                'name'      => $this->name ,
                'status'    => 0 ,
                'user_id'   => auth()->user()->id
            ]);

            session()->flash('success','Task Created Successfully!!');
            $this->resetFields();
            $this->addTask = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }
   
    public function editTask($id)
    {
        try {
            $task = Tassk::findOrFail($id);
            if( !$task) {
                session()->flash('error','Task not found');
            } else {
                $this->name = $task->name;
                $this->taskId = $task->id;
                $this->status = $task->status;
                $this->updateTask = true;
                $this->addTask = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }

    }

    public function updateTaskData()
    {
        $this->validate();
        try {
            Tassk::whereId($this->taskId)->update([
                'name'      => $this->name ,
                'status'    => $this->status
            ]);
            session()->flash('success','Task Updated Successfully!!');
            $this->resetFields();
            $this->updateTask = false;
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }

    
    public function cancelTask()
    {
        $this->addTask = false;
        $this->updateTask = false;
        $this->resetFields();
    }
    
    public function deleteTask($id)
    {
        try{
            Tassk::find($id)->delete();
            session()->flash('success',"Task Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }

    public function render()
    {
        $this->tasks = Tassk::where('user_id', auth()->user()->id)->get();

        return view('livewire.tasks.task')
            ->layout('layouts.app');
    }

}
