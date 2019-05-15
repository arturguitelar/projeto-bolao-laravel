<div class="row">    
    <div class="form-group col-6">
        <label for="name">{{ __('bolao.name') }}</label>
        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? ($register->name ?? '') }}">
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif        
    </div>

    <div class="form-group col-6">
        <label for="description">{{ __('bolao.description') }}</label>
        <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ?? ($register->description ?? '') }}">
        @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif        
    </div>
</div>
