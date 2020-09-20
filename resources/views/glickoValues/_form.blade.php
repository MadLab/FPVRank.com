<div class="row">
    <div class="form-group col-sm-12 col-lg-6">
        <label for="rating">Rating<span class="badge badge-danger">Required</span></label>
        <input name="rating" type="text" class="form-control @error('rating') is-invalid @enderror" id="rating"
            placeholder="" required="" value="{{ !isset($obj->rating) ? old('rating') : $obj->rating }}">
        @error('rating')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>     
    
    <div class="form-group col-sm-12 col-lg-6">
        <label for="rd">RD<span class="badge badge-danger">Required</span></label>
        <input name="rd" type="text" class="form-control @error('rd') is-invalid @enderror" id="rd"
            placeholder="" required="" value="{{ !isset($obj->rd) ? old('rd') : $obj->rd }}">
        @error('rd')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 
    
    <div class="form-group col-sm-12 col-lg-6">
        <label for="volatility">Volatility<span class="badge badge-danger">Required</span></label>
        <input name="volatility" type="text" class="form-control @error('volatility') is-invalid @enderror" id="volatility"
            placeholder="" required="" value="{{ !isset($obj->volatility) ? old('volatility') : $obj->volatility }}">
        @error('volatility')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 

    <div class="form-group col-sm-12 col-lg-6">
        <label for="mu">MU<span class="badge badge-danger">Optional</span></label>
        <input name="mu" type="text" class="form-control @error('mu') is-invalid @enderror" id="mu"
            placeholder="" value="{{ !isset($obj->mu) ? old('mu') : $obj->mu }}">
        @error('mu')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 

    <div class="form-group col-sm-12 col-lg-6">
        <label for="phi">PHI<span class="badge badge-danger">Optional</span></label>
        <input name="phi" type="text" class="form-control @error('phi') is-invalid @enderror" id="phi"
            placeholder="" value="{{ !isset($obj->phi) ? old('phi') : $obj->phi }}">
        @error('phi')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 

    <div class="form-group col-sm-12 col-lg-6">
        <label for="sigma">Sigma<span class="badge badge-danger">Optional</span></label>
        <input name="sigma" type="text" class="form-control @error('sigma') is-invalid @enderror" id="sigma"
            placeholder="" value="{{ !isset($obj->sigma) ? old('sigma') : $obj->sigma }}">
        @error('sigma')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 

    <div class="form-group col-sm-12 col-lg-6">
        <label for="systemconstant">System Constant<span class="badge badge-danger">Required</span></label>
        <input name="systemconstant" type="text" class="form-control @error('systemconstant') is-invalid @enderror" id="systemconstant"
            placeholder="" required="" value="{{ !isset($obj->systemconstant) ? old('systemconstant') : $obj->systemconstant }}">
        @error('systemconstant')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 

    <div class="form-group col-sm-12 col-lg-6">
        <label for="pi2">pi2<span class="badge badge-danger">Required</span></label>
        <input name="pi2" type="text" class="form-control @error('pi2') is-invalid @enderror" id="pi2"
            placeholder="" required="" value="{{ !isset($obj->pi2) ? old('pi2') : $obj->pi2 }}">
        @error('pi2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> 

</div>