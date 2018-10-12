@if($products->total() > 12)
<nav aria-label="Page navigation example" class="pull-left navigation-products">
    <div class="pagination pagination-sm">
        {!! $products->appends(['categoria' => Request::input('categoria'), 'q' => Request::input('q'), 'filtrar' => Request::input('filtrar')])->render("pagination::bootstrap-4") !!}
    </div>
</nav>
@else
    <nav aria-label="Page navigation example" class="pull-left navigation-products">
        <ul class="pagination pagination-sm">
            <li class="page-item disabled ">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item disabled "><a class="page-link" href="#">1</a></li>
            <li class="page-item disabled ">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
@endif