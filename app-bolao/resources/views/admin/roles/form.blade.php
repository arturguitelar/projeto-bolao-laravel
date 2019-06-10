<div class="row">    
    @php
        $fields = [
            'name', 'description'
        ];
    @endphp

    @foreach ($fields as $item)

        <div class="form-group col-6">
            <label for="{{$item}}">{{ __('bolao.' . $item) }}</label>
            <input type="text" 
                class="form-control{{ $errors->has($item) ? ' is-invalid' : '' }}" 
                name="{{$item}}" value="{{ old($item) ?? ($register->$item ?? '') }}">
            @if ($errors->has($item))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first($item) }}</strong>
            </span>
            @endif        
        </div>        
    @endforeach

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
