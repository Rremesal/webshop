<fieldset class="border p-2 rounded flex flex-wrap border-blue-400">
    <legend>Users</legend>
    <input type="text" wire:model.live="search" class="w-full" placeholder="Search...">
    @foreach ($users as $user)
        <div class="bg-gray-300 p-1 m-1 rounded hover:bg-gray-200">
            <input type="checkbox" id="{{ $user->id }}" {{ $user['set'] ? 'checked' : '' }} name="{{ $user->id }}"><label for="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</label>
        </div>
    @endforeach

</fieldset>
