<div class="form-group row">
    <label for="pilotId" class="col-md-4 col-form-label text-md-right">ID</label>
    <div class="col-md-6">
        <input id="pilotId" type="text" class="form-control @error('pilotId') is-invalid @enderror" 
        name="pilotId" value="{{ !isset($pilot->pilotId) ? old('pilotId') : $pilot->pilotId }}" required 
        autocomplete="name" autofocus>
        @error('pilotId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
        name="name" value="{{ !isset($pilot->name) ? old('name') : $pilot->name }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
    <div class="col-md-6">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" 
        name="username" value="{{ !isset($pilot->username) ? old('username') : $pilot->username }}" required autocomplete="email">
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
