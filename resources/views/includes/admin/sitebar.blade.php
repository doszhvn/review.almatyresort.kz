<ul
    class="nav sidebar-menu flex-column"
    data-lte-toggle="treeview"
    role="menu"
    data-accordion="false"
>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi bi-table"></i>
            <p>
                Reviews
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach(App\Enum\BranchEnum::slugToName() as $branch_slug => $branch_name)
                <li class="nav-item">
                    <a href="{{route('review.list',['branch_slug' => $branch_slug])}}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>{{$branch_name}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-pencil-square"></i>
            <p>
                Reports
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach(App\Enum\BranchEnum::slugToName() as $branch_slug => $branch_name)
                <li class="nav-item">
                    <a href="{{route('reports.list',['branch_slug' => $branch_slug])}}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>{{$branch_name}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
</ul>
