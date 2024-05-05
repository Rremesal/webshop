<article class="lg:h-screen bg-white lg:w-1/6 shadow-md m-2">
    <header class="text-lg font-bold flex justify-between mx-2 py-2">
        <span>Roles</span>
        <a class="hover:bg-gray-200 rounded-full px-1" href="{{ route('roles.index') }}"><i class="w-full h-full fa-solid fa-plus"></i></a>
    </header>
    <main>
        <div class="px-2">
            <input class="max-w-60" wire:model.live="search" type="text" placeholder="Search...">
        </div>
        <div class="overflow-y-scroll lg:h-full h-40">
            @foreach ($roles as $role)
                <a href="{{ route('roles.edit', $role) }}" class=" {{ $selectedRole  && $selectedRole->id === $role->id ? 'bg-gray-300' : '' }} p-2 block hover:cursor-pointer hover:bg-gray-200">{{ $role->name }}</a>
            @endforeach
        </div>

    </main>
</article>
