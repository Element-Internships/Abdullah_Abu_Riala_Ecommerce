<!-- resources/views/pagination/custom.blade.php -->
<div class="product__pagination mt-4">
    @if ($paginator->onFirstPage())
        <a href="#" class="disabled"><i class="fa fa-long-arrow-left"></i></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <a href="#" class="disabled">{{ $element }}</a>
        @elseif (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="#" class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
    @else
        <a href="#" class="disabled"><i class="fa fa-long-arrow-right"></i></a>
    @endif
</div>
