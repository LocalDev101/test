<div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form>

                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button wire:click.prevent="storeTask()" class="btn btn-success btn-block">Save</button>
                        <button wire:click.prevent="cancelTask()" class="btn btn-secondary btn-block">Cancel</button>
                    </div>
    
                </form>

            </div>
        </div>
    </div>
 
</div>