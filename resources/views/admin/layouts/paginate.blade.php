@php
$current = $paginator->currentPage();
$last = $paginator->lastPage();
$prev = 1;
$next = 5;

if($last < 5 or $current + 1 >= $last){
    $prev = $current < 5 ? 1 : ($current > $last - 5 ? $last - 4 : $current -1);
    $next = $last;
}elseif($last > 5 && $current < 5){
    $prev = 1;
    $next = 5;
}elseif($current >= 5){
    $prev = $current -1;
    $next = $current +1;
}

$filter = request()->query();
$filter['page'] = 0;
@endphp


<ul class="pagination pagination-sm m-0 float-right">
    <li class="page-item" @if($current == 1) disabled @endif>
        <form action="" method="get">
            @foreach ($filter as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$key == 'page' ? $current - 1 : $value}}">
            @endforeach
            <button type="{{$current == 1 ? 'button' : 'submit'}}" class="page-link">&laquo;</button>
        </form>
    </li>
    @if ($current >= 5)
        <li class="page-item">
            <form action="" method="get">
                @foreach ($filter as $key => $value)
                    <input type="hidden" name="{{$key}}" value="{{$key == 'page' ? 1 : $value}}">
                @endforeach
                <button type="submit" class="page-link" href="#">1</button>
            </form>
        </li>
        <li class="page-item"><a class="page-link" href="#!">...</a></li>
    @endif
    @for ($prev; $prev <= $next; $prev++)
    <li class="page-item @if($paginator->currentPage() == $prev) active @endif">
        <form action="" method="get">
            @foreach ($filter as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$key == 'page' ? $prev : $value}}">
            @endforeach
            <button type="submit" class="page-link @if($paginator->currentPage() == $prev) text-white @endif" href="#">{{$prev}}</button>
        </form>
    </li>
    @endfor
    @if ($next < $paginator->lastPage())
        <li class="page-item"><a class="page-link" href="#!">...</a></li>
        <li class="page-item">
            <form action="" method="get">
                @foreach ($filter as $key => $value)
                    <input type="hidden" name="{{$key}}" value="{{$key == 'page' ? $paginator->lastPage() : $value}}">
                @endforeach
                <button type="submit" class="page-link" href="#">{{$paginator->lastPage()}}</button>
            </form>
        </li>
    @endif
    <li class="page-item @if($current == $last) disabled @endif">
        <form action="" method="get">
            @foreach ($filter as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$key == 'page' ? $current + 1 : $value}}">
            @endforeach
            <button type="{{$current == $last ? 'button' : 'submit'}}" class="page-link" href="#">&raquo;</button>
        </form>
    </li>
</ul>