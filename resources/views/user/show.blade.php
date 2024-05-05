@props(['permission' => null])
<x-app-layout>
    <section class="my-0 mx-auto w-[80%]">
        <article>
            <header>{{ $user->first_name.' '.$user->last_name }}</header>
        </article>

        <article>
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($roles as $role)
                    <div class=" w-52 min-h-52 flex flex-col p-3 shadow-md bg-white rounded">
                        <div class="w-full border-b-2 mb-3 flex items-center justify-between">
                            <h1 class="font-bold">{{ $role->name }}</h1>
                            <input name="{{ 'role_'.$role->name }}" {{ $role['set'] ? 'checked' : '' }} type="checkbox">
                        </div>
                        @foreach ($role->permissions as $permission)
                        <div>
                            <input name="{{ $permission->name }}" {{ $permission['set'] ? 'checked' : '' }} type="checkbox">
                            <label class="italic">{{ $permission->name }}</label>
                        </div>

                        @endforeach
                    </div>
                @endforeach
                <x-primary-button>Save</x-primary-button>
            </form>
        </article>
    </section>


</x-app-layout>
