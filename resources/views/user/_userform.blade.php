<div class="row">
    <div class="form-group col-6">
        <label for="name">Name<span class="badge badge-danger">Required</span></label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" required="" value="{{ !isset($user->name) ? old('name') : $user->name }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="email">E-mail Address <span class="badge badge-danger">Required</span></label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" required="" value="{{ !isset($user->email) ? old('email') : $user->email }}">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label class="d-flex justify-content-between" for="password"><span>@if(Route::currentRouteName() == 'user.edit')
                **
                @endif{{ __('Password') }}</span> <a href="#password" data-toggle="password"><i class="fa fa-eye fa-fw"></i> <span>Show</span></a></label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label class="d-flex justify-content-between" for="password-confirm"><span>@if(Route::currentRouteName() == 'user.edit')
                **
                @endif{{ __('Confirm Password') }}</span> <a href="#password-confirm" data-toggle="password"><i class="fa fa-eye fa-fw"></i> <span>Show</span></a></label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @if(Route::currentRouteName() == 'user.edit')
    <div>
        **Empty if you want to keep same password
    </div>
    @endif
</div>
