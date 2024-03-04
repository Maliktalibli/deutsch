<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ (request()->is('/*')) ? 'active' : '' }}">
                <a class="sidebar-link" href="{{route('front.index')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Unregular Verbs</span>
                </a>
            </li>

            <li class="sidebar-item {{ (request()->is('words*')) ? 'active' : '' }}">
                <a class="sidebar-link" href="{{route('front.words')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Words</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Loading...</span>
                </a>
            </li>

        </ul>
    </div>
</nav>