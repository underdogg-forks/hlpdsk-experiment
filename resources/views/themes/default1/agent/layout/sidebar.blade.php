@section('Tools')
    class="active"
@stop
@section('tools-bar')
    active
@stop
@section('kb')
    class="active"
@stop
@section('sidebar')

<li class="nav-header">{{strtoupper(trans('lang.knowledge_base'))}}</li>

<li @yield('category-menu-parent') class="nav-item">
                                
    <a href="#" @yield('category') class="nav-link">
        <i class="nav-icon fas fa-list-ul"></i>
        <p>{{ trans('lang.category') }}<i class="right fas fa-angle-left"></i></p>
    </a>

    <ul @yield('category-menu-open') class="nav nav-treeview">

        <li class="nav-item">
            <a @yield('add-category') href="{{url('category/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('lang.addcategory') }}</p>
            </a>
        </li>

        <li class="nav-item">
            <a @yield('all-category') href="{{url('category')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('lang.allcategory') }}</p>
            </a>
        </li>
    </ul>
</li>

<li @yield('article-menu-parent') class="nav-item">
                                
    <a href="#" @yield('article') class="nav-link">
        <i class="nav-icon fas fa-edit"></i>
        <p>{{ trans('lang.article') }}<i class="right fas fa-angle-left"></i></p>
    </a>

    <ul @yield('article-menu-open') class="nav nav-treeview">

        <li class="nav-item">
            <a @yield('add-article') href="{{url('article/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('lang.addarticle') }}</p>
            </a>
        </li>

        <li class="nav-item">
            <a @yield('all-article') href="{{url('article')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('lang.allarticle') }}</p>
            </a>
        </li>
    </ul>
</li>

<li @yield('page-menu-parent') class="nav-item">
                                
    <a href="#" @yield('pages') class="nav-link">
        <i class="nav-icon far fa-file-code"></i>
        <p>{{ trans('lang.pages') }}<i class="right fas fa-angle-left"></i></p>
    </a>

    <ul @yield('page-menu-open') class="nav nav-treeview">

        <li class="nav-item">
            <a @yield('add-pages') href="{{url('page/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('lang.addpages') }}</p>
            </a>
        </li>

        <li class="nav-item">
            <a @yield('all-pages') href="{{url('page')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('lang.allpages') }}</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{url('comment')}}" @yield('comment')  class="nav-link">
        <i class="fas fa-comment"></i>
        <p>{{ trans('lang.comments') }}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{url('kb/settings')}}" @yield('settings') class="nav-link">
         <i class="fas fa-cog"></i>
        <p>{{ trans('lang.settings') }}</p>
    </a>
</li>
@stop