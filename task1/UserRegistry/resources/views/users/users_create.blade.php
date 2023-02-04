<form method="post" action="{{ route('users.store') }}" data-parsley-validate
      class="">


    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="inline-md-block" id="title">Add new user</h1>
            </div>
            <div class="modal-body">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label style="margin-top: 10px" for="first_name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10 col-md-12 col-lg-12">
                        <input type="text" value="{{ Request::old('first_name') ?: '' }}" id="first_name"
                               name="first_name"
                               class="form-control col-md-7 col-xs-12 md-text-input">
                        <div class="md-text-box-border-bottom"></div>
                        @if ($errors->has('first_name'))
                            <span class="help-block">{{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} ">
                    <label style="margin-top: 10px" for="last_name" class="col-sm-2 col-form-label">Surname</label>
                    <div class="col-sm-10 col-md-12 col-lg-12">
                        <input type="text" value="{{ Request::old('last_name') ?: '' }}" id="last_name" name="last_name"
                               class="form-control col-md-7 col-xs-12 md-text-input">
                        <div class="md-text-box-border-bottom"></div>
                        @if ($errors->has('last_name'))
                            <span class="help-block">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
                    <label style="margin-top: 10px" for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-11 col-md-12 col-lg-12 md-text-box">
                        <input type="text" value="{{ Request::old('email') ?: '' }}" id="email" name="email"
                               class="form-control col-md-7 col-xs-12 md-text-input">
                        <div class="md-text-box-border-bottom"></div>
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                    <label style="margin-top: 10px" for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10 col-md-12 col-lg-12">
                        <input type="password" value="{{ Request::old('password') ?: '' }}" id="password"
                               name="password"
                               class="form-control col-md-7 col-xs-12 md-text-input">
                        <div class="md-text-box-border-bottom"></div>
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }} ">
                    <label style="margin-top: 10px" for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10 col-md-12 col-lg-12">
                        <input type="password" value="{{ Request::old('confirm_password') ?: '' }}"
                               id="confirm_password"
                               name="confirm_password"
                               class="form-control col-md-7 col-xs-12 md-text-input">
                        <div class="md-text-box-border-bottom"></div>
                        @if ($errors->has('confirm_password'))
                            <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-form-label" for="category_id">Position
                        <span class="required">*</span>
                    </label>
                    <div class="col-xs-12 col-sm-11 col-md-12 col-lg-12 md-text-box">
                        <select class="form-control md-text-input md-text-input" id="role_id" name="role_id">
                            <div class="md-text-box-border-bottom"></div>

                            @if(count($roles))
                                @foreach($roles as $row)
                                    <option
                                            value="{{$row->id}}" {{isset($user->roles[0]) && $row->id == $user->roles[0]->id ? 'selected="selected"' : ''}}>{{$row->display_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('role_id'))
                            <span class="help-block">{{ $errors->first('role_id') }}</span>
                        @endif
                        <div class="md-text-box-border-bottom"></div>

                    </div>
                </div>

                <div class="ln_solid"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-6 col-sm-6 col-xs-12 right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <button type="submit" class="btn btn-success">Create User</button>
                </div>
            </div>

        </div>
    </div>
</form>
