<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="bg-white p-5 rounded-4 shadow-sm border">
                <h3 class="fs-2 fw-bold mb-4 text-center text-{{ $project ? 'primary' : 'success' }}">
                    {{ $project ? 'Update Project' : 'Create Project' }}</h3>

                <form wire:submit.prevent="save">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="name" wire:model.defer="name"
                            placeholder="Project Name">
                        <label for="name">Project Name</label>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control rounded-3" id="description" wire:model.defer="description" placeholder="Description"
                            style="height: 100px;"></textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select rounded-3" id="status" wire:model.defer="status">
                            <option value="">Select Status</option>
                            @foreach ($statuses as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                        <label for="status">Status</label>
                        @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <select class="form-select rounded-3" id="user_id" wire:model.defer="user_id">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <label for="user_id">Assigned User</label>
                        @error('user_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn btn-{{ $project ? 'primary' : 'success' }} w-100 py-2 rounded-pill fw-semibold"
                        wire:loading.attr="disabled" wire:target="save">
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-2"
                            role="status" aria-hidden="true"></span>
                        <span wire:loading.remove wire:target="save">
                            {{ $project ? 'Update Project' : 'Create Project' }}
                        </span>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
