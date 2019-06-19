<div class="row">

    <div class="form-group col-12">
        <label for="title">{{ __('bolao.title') }}</label>
        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ?? ($register->title ?? '') }}">
        @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif        
    </div>

    <div class="form-group col-6">
        <label for="round_id">{{ __('bolao.round') }}</label>
        <select name="round_id"
            class="form-control{{ $errors->has('round_id') ? ' is-invalid' : '' }}">
            @foreach ($listRel as $item)
                @php
                    $select = '';

                    if (old('round_id') ?? false) {

                        if (old('round_id') == $item->id) $select = 'selected';
                    } else {

                        if ($register_id ?? false) {
                            if ($register_id == $item->id) $select = 'selected';
                        }
                    }
                @endphp
                <option {{ $select }} value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach
        </select>
        @if ($errors->has('round_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('round_id') }}</strong>
        </span>
        @endif       
    </div>

    @php
        $fields = [
            'stadium', 'team_a', 'team_b', 'scoreboard_a', 'scoreboard_b'
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
        <label for="result">@lang('bolao.result') @lang('bolao.result_description')</label>
        <select name="result"
            class="form-control{{ $errors->has('result') ? ' is-invalid' : '' }}">

            @php
                $list = ['A', 'B', 'E'];    
            @endphp

            @foreach ($list as $value)
                @php
                    $select = '';

                    if (old('result') ?? false) {

                        if (old('result') == $value) $select = 'selected';
                    } else {

                        if ($register->result ?? false) {
                            if ($register->result == $value) $select = 'selected';
                        } else {
                            if ($value == 'E') $select = 'selected';
                        }
                    }
                @endphp
                <option {{ $select }} value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
        @if ($errors->has('result'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('result') }}</strong>
        </span>
        @endif       
    </div>

    <div class="form-group col-6">
        <label for="date">{{ __('bolao.date') }} - ex.: ({{ date('d-m-Y H:i:s') }})</label>
        <input type="datetime"
            placeholder="{{ date('d-m-Y H:i:s') }}" 
            class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" 
            name="date" value="{{ old('dater') ?? ($register->date ?? '') }}">
        @if ($errors->has('date'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('date') }}</strong>
        </span>
        @endif        
    </div>
</div>
