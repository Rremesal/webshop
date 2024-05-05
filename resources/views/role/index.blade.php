@props(['selectedRole' => null])
<x-app-layout>
    <section class="lg:flex">
        <livewire:roles-overview :role="$selectedRole" />
        <article class="bg-white w-full shadow-md m-2">
            <form method="POST" class="p-4"
                action="{{ $selectedRole ? route('roles.update', $selectedRole) : route('roles.store') }}">
                @csrf
                @method($selectedRole ? 'PUT' : 'POST')
                <fieldset class="border p-2 rounded border-blue-400">
                    <legend>
                        <label for="role">Role</label>
                    </legend>
                    <div>
                        <input type="text" name="role" id="role"
                            value="{{ $selectedRole ? old('role', $selectedRole->name) : '' }}">
                        @error('role')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-2 rounded border-blue-400">
                    <legend>Permissions</legend>
                    <div>
                        <input name="permission" type="text" placeholder="Name for new permission...">
                        <hr class="my-4">
                        @error('permission')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class=" flex flex-col w-fit h-32 flex-wrap">
                            @foreach ($permissions as $permission)
                                <div>
                                    <input class="mx-1" {{ $permission->set ? 'checked' : '' }} type="checkbox"
                                        name="{{ $permission->name }}"><label>{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </fieldset>
                <livewire:user-overview/>
                <x-primary-button class=" float-end my-2">{{ $selectedRole ? 'Update' : 'Create' }}</x-primary-button>
            </form>
        </article>
    </section>
</x-app-layout>
