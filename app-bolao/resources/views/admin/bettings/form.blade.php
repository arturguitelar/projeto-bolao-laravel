<div class="row"> 
    
    @php
        $fields = [
            'title', 'value_result', 'extra_value', 'value_fee'
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
</div>
