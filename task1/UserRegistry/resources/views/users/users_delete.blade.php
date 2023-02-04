
    <div class="flex-wrap pb-2 mb-8">
        <h1 class="inline-md-block" id="title">{{$user->first_name}}</h1>
    </div>

    <div class="light-g-bg x">
        <p class="mb-4">Please confirm that you would like to delete this user.
            <strong>{{$user->name}}</strong>
        </p>

    <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn">confirm</button>
    </form>
    </div>

