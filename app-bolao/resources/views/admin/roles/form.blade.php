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

    <div class="form-group col-6">
        <label for="permissions">{{ __('bolao.permission_list') }}</label>
        <select multiple class="form-control" name="permissions[]">
            @foreach ($permissions as $key => $value)
                @php
                    $select = '';
                    
                    /**
                     * Neste caso, impede que o select atualize sem registros
                     * caso um dos campos peça validação.
                     */
                    if (old('permissions') ?? false) {
                        foreach (old('permissions') as $key => $id) {

                            if ($id == $value->id) $select = 'selected';
                        }
                    } else {

                        /**
                         * Se existir um registro, então o select já deve
                         * vir marcado com as opções deste registro.
                         */
                        if ($register ?? false) {

                            foreach ($register->permissions as $key => $permission) {
                                
                                if ($permission->id == $value->id) $select = 'selected';
                            }
                        }
                    }

                @endphp

                <option {{ $select }} value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
</div>
