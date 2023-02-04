    <a class="btn btn-sm btn-primary" href="{{route('users.index')}}">Back to users</a>
    <div class="flex-wrap flex-md-nowrap align-items-center pb-2 mb-8 border-bottom">
        <h1 class="inline-md-block" id="title">{{$user->first_name}}</h1>
        <div class="nav-item n active right">
            <a class="btn btn-sm btn-primary p-5" href="{{ route('users.show', ['user' => $user]) }}">Remove user</a>
        </div>
    </div>

    <div class="light-g-bg">
        <form method="post" action="{{ route('users.update', ['user' => $user]) }}" data-parsley-validate
              class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} row inline-md-block col-xs-12 col-sm-12 col-md-5 col-lg-5 m-y-24">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10 col-md-12 col-lg-12">
                    <input type="text" value="{{$user->name}}" id="first_name" name="first_name"
                           class="form-control col-md-7 col-xs-12 md-text-input">
                    <div class="md-text-box-border-bottom"></div>
                    @if ($errors->has('first_name'))
                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} row right col-xs-12 col-sm-12 col-md-5 col-lg-5 m-y-24">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10 col-md-12 col-lg-12">
                    <input type="text" value="{{$user->last_name}}" id="last_name" name="last_name"
                           class="form-control col-md-7 col-xs-12 md-text-input">
                    <div class="md-text-box-border-bottom"></div>
                    @if ($errors->has('last_name'))
                        <span class="help-block">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row m-y-24">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-11 col-md-12 col-lg-12 md-text-box">
                    <input type="text" value="{{$user->email}}" id="email" name="email"
                           class="form-control col-md-7 col-xs-12 md-text-input">
                    <div class="md-text-box-border-bottom"></div>

                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row inline-md-block col-xs-12 col-sm-12 col-md-5 col-lg-5 m-y-24">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10 col-md-12 col-lg-12">
                    <input type="password" value="{{ Request::old('password') ?: '' }}" id="password" name="password"
                           class="form-control col-md-7 col-xs-12 md-text-input">
                    <div class="md-text-box-border-bottom"></div>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }} row right col-xs-12 col-sm-12 col-md-5 col-lg-5 m-y-24">
                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10 col-md-12 col-lg-12">
                    <input type="password" value="{{ Request::old('confirm_password') ?: '' }}" id="confirm_password"
                           name="confirm_password"
                           class="form-control col-md-7 col-xs-12 md-text-input">
                    <div class="md-text-box-border-bottom"></div>
                    @if ($errors->has('confirm_password'))
                        <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }} row m-y-24">
                <label class="col-sm-2 col-form-label" for="category_id">Role
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

            <div class="form-group m-y-26">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-success m-y-24">Apply Changes</button>
                </div>
            </div>
        </form>
    </div>
