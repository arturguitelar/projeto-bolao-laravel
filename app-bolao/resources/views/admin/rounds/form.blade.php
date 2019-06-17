<div class="row">
    
    @php
        $fields = [
            'date_start', 'date_end'
        ];
    @endphp

    <div class="form-group col-6">
        <label for="title">{{ __('bolao.title') }}</label>
        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ?? ($register->title ?? '') }}">
        @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif        
    </div>

    <div class="form-group col-6">
        <label for="betting_id">{{ __('bolao.betting_list') }}</label>
        <select name="betting_id"
            class="form-control{{ $errors->has('betting_id') ? ' is-invalid' : '' }}">
            @foreach ($listRel as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach
        </select>
        @if ($errors->has('betting_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('betting_id') }}</strong>
        </span>
        @endif       
    </div>

    @foreach ($fields as $item)

        <div class="form-group col-6">
            <label for="{{$item}}">{{ __('bolao.' . $item) }} - ex.: ({{ date('d-m-Y H:i:s') }})</label>
            <input type="date-time"
                placeholder="{{ date('d-m-Y H:i:s') }}" 
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
