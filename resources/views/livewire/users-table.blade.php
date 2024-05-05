<article>
    <header></header>
    <main class="flex justify-center">
        <table wire:poll.5s>
            <thead class="bg-blue-400 text-white">
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Access</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="py-2 border-t-2">{{ $user->first_name }}</td>
                        <td class="py-2 border-t-2">{{ $user->last_name }}</td>
                        <td class="py-2 border-t-2">{{ $user->email }}</td>
                        <td class="py-2 border-t-2 text-center ">
                            <a class="w-full h-full" href="{{ route('users.edit', $user) }}"><i class="fa-solid fa-up-right-from-square"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</article>
