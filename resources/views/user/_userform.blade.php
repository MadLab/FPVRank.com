<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
        name="name" value="{{ !isset($user->name) ? old('name') : $user->name }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
        name="email" @if(Route::currentRouteName() == 'user.edit') readonly @endif 
        value="{{ !isset($user->email) ? old('email') : $user->email }}" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@if(Route::currentRouteName() == 'user.edit')
<div>
    **Empty if you want to keep same password
</div>
@endif
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">@if(Route::currentRouteName() == 'user.edit')
    **
    @endif{{ __('Password') }}</label>
    <div class="col-md-6">    
        <input id="password" type="password" 
        class="form-control @error('password') is-invalid @enderror" 
        name="password" autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@if(Route::currentRouteName() == 'user.edit')
    **
    @endif{{ __('Confirm Password') }}</label>
    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
        name="password_confirmation" autocomplete="new-password">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>