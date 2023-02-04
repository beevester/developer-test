<x-admin-layout>

    <div class="flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="inline-md-block" id="title">Users</h1>
        <div class="nav-item n active right">
            <a class="btn btn-sm btn-primary p-5" href="{{route('users.create')}}">Create New User</a>
        </div>
    </div>

    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">

    <div class="responsive-table col-md-12 col-lg-12">
        <table style="width: 100%">
            <thead>
            <tr class="table-header">
                <th class="col-2">First Name</th>
                <th class="col-2">Last Name</th>
                <th class="col-4">Email</th>
                <th class="col-2">Role</th>
                <th class="col-1">Member since</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="table-row"  onclick="window.location='{{ route('users.edit', ['user' => $user]) }}'"  role='button'>
                    <td class="col-2">{{ $user->first_name }}</td>
                    <td class="col-2">{{ $user->last_name }}</td>
                    <td class="col-4">{{ $user->email }}</td>
                    <td class="col-2">
                        @foreach($user->roles as $r)
                            {{$r->display_name}}
                        @endforeach
                    </td>
                    <td class="col-1">
                        {{ date('d M Y', strtotime($user->updated_at)) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div id="links">
            {{ $users->links() }}
        </div>
    </div>
    </div>
    </div>
</x-admin-layout>
