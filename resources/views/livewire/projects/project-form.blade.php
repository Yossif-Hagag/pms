<div>
    <div class="p-4 border rounded">
        @if (session()->has('message'))
            <div class="bg-green-100 p-2 mb-2">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="save">
            <div class="mb-2">
                <label>Name</label>
                <input type="text" wire:model="name" class="border p-1 w-full">
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label>Description</label>
                <textarea wire:model="description" class="border p-1 w-full"></textarea>
            </div>

            <div class="mb-2">
                <label>Status</label>
                <select wire:model="status" class="border p-1 w-full">
                    @foreach ($statuses as $statusOption)
                        <option value="{{ $statusOption['value'] }}">
                            {{ $statusOption['label'] }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label>User</label>
                <select wire:model="user_id" class="border p-1 w-full">
                    <option value="">Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Save</button>
        </form>
    </div>
</div>
