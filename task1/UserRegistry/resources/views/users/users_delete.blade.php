<x-admin-layout>
    <a href="{{ route('users.edit', ['user' => $user]) }}">Back to user</a>
    <div class="flex-wrap pb-2 mb-8">
        <h1 class="inline-md-block" id="title">{{$user->first_name}}</h1>
    </div>

    <div class="light-g-bg x">
        <p class="mb-4">Are you sure you want to delete
            <strong>{{$user->name}}</strong>
        </p>

    <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
    </form>
    </div>
</x-admin-layout>
