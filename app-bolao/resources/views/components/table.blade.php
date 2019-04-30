<table class="table">
    <thead>
        <tr>
            @foreach ($columnList as $key => $value)
                <th scope="col">{{$value}}</th>
            @endforeach

            <th scope="col">@lang('bolao.action')</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($list as $key => $value)       
            <tr>
                @foreach ($columnList as $key2 => $value2)
                    @if ($key2 == 'id')
                        <th scope="row">@php echo $value->{$key2} @endphp</th>
                    @else
                        <td>@php echo $value->{$key2} @endphp</td>
                    @endif
                @endforeach
                
                <td>                    
                    <a href="{{route($routeName.'.show',$value->id)}}">
                        <i style="color:black" class="material-icons">pageview</i>
                    </a>
                    <a href="{{route($routeName.'.edit',$value->id)}}">
                        <i style="color:orange" class="material-icons">create</i>
                    </a>
                    <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}">
                        <i style="color:red" class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
