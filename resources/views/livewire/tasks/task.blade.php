<div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="col-md-8 mb-2">
                
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    @if($addTask)
                        @include('livewire.tasks.create')
                    @endif
                    @if($updateTask)
                        @include('livewire.tasks.edit')
                    @endif
                    
                </div>

                @if(!$addTask)
                    <button wire:click="showTaskForm()" class="btn btn-primary btn-sm float-right">Add New Task</button>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                                @forelse($tasks as $task)
                                    <tr>
                                        <td>
                                            {{$task->name}}
                                        </td>
                                    
                                        <td>
                                            <button wire:click="editTask({{$task->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="deleteTask({{$task->id}})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>     
                                        <td colspan="3" align="center">
                                            No Task Found.
                                        </td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
</div>
