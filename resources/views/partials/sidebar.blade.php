<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('home')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
                </svg>
                Dashboard
            </a>
        </li>


        @if(auth()->user()->is_admin)
            <li class="c-sidebar-nav-title">{{__('Admin')}}</li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link "
                   href=" {{route('admin.pages.index')}} ">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle')}}"></use>
                </svg>
                Pages
                </a>
            </li>
            <li class="c-sidebar-nav-title">{{__('Manage CheckList')}}</li>
            @foreach(\App\Models\ChecklistGroup::with('checklists')->get()  as $group)
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show">
                    <a class="c-sidebar-nav-link  c-sidebar-nav-dropdown-toggle"
                       href=" {{route('admin.checklist_groups.edit',$group->id)}} ">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle')}}"></use>
                        </svg>
                        {{$group->name}}
                    </a>

                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach ($group->checklists as $checklist)
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link"
                                   href=" {{route('admin.checklist_groups.checklists.edit',[$group,$checklist] )}} ">
                                    <span class="c-sidebar-nav-icon"></span>
                                    {{$checklist->name}}
                                </a>
                            </li>
                        @endforeach
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('admin.checklist_groups.checklists.create',$group)}}">
                                    {{__('New checklists')}}
                                </a>
                            </li>
                    </ul>
                </li>
            @endforeach
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{route('admin.checklist_groups.create')}}">
                    {{__('New checklists group')}}
                </a>
            </li>
        @endif
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle')}}">

                    </use>
                </svg>
                Base
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/cards.html"><span
                            class="c-sidebar-nav-icon"></span> Cards</a></li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                </svg>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </li>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 616px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 508px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
