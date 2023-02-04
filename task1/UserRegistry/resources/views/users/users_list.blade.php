@extends('layouts.app')

@section('content')
        <div style="margin: 16px">
            <a class="btn btn-sm btn-primary p-5" onclick="createUser()" data-toggle="modal"
               data-target="#createModal" style="float: right;">Create
                New User</a>
        </div>

    <div class="responsive-table col-md-12 col-lg-12" style="margin-top: 30px">
        <table style="width: 100%">
            <tbody>
            @foreach($users as $user)
                <tr class="table-row">
                    <td class="col-2" onclick="window. window.location='{{ route('users.edit', ['user' => $user]) }}'"
                        role='button'>{{ $user->name }}</td>
                    <td class="col-2" onclick="window. window.location='{{ route('users.edit', ['user' => $user]) }}'"
                        role='button'>{{ $user->email }}</td>
                    <td class="col-1" data-toggle="modal" data-target="#deleteUser{{ $user->id }}" role='button'>
                        {{ date('d M Y', strtotime($user->updated_at)) }}
                    </td>
                </tr>

                <div class="modal fade" style="top: 20%" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body" id="create">
                                <div class="flex-wrap pb-2 mb-8">
                                    <h1 class="inline-md-block" id="title">{{$user->first_name}}</h1>
                                </div>
                                <div class="light-g-bg x">
                                    <p class="mb-4">Are you sure you want to delete
                                        <strong>{{$user->name}}</strong>
                                    </p>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="deleteUser({{ $user->id }})">
                                    Yes I'm sure. Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="createModal" style="top: 20%" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
        </div>


        <div id="links">
            {{ $users->links() }}
        </div>
    </div>
    <script>
        function createUser() {
            $.ajax({
                url: '/users/create',
                type: 'get',
                success: function (data) {
                    console.log(data);
                    $("#createModal").html(data)
                }
            })
        }

        function deleteUser(id) {
            $.ajax({
                url: `/users/${id}`,
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    $(`#deleteUser${id}`).modal('hide');
                    location.reload();
                }
            })
        }
    </script>
@endsection()
