<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active">
        <a href="/allusers">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
        </a>        
    </li>
    <li {!! Request::is('*users*') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        @if(Entrust::can('user.read'))
            <li {!! Request::is('*allusers*') ? ' class="active"' : null !!}><a href="{{url('allusers')}}"><i class="fa fa-circle-o"></i> All User</a></li>
        @endif
        @if(Entrust::can('user.create'))   
            <li {!! Request::is('*create_users*') ? ' class="active"' : null !!}><a href="{{url('create_users')}}"><i class="fa fa-circle-o"></i> New User</a></li>
        @endif            
        </ul>
    </li>
    <li {!! Request::is('*Event*') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Events</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        @if(Entrust::can('event.read'))
            <li {!! Request::is('*allEvents*') ? ' class="active"' : null !!}><a href="{{url('allEvents')}}"><i class="fa fa-circle-o"></i> All Events</a></li>
        @endif
        @if(Entrust::can('event.create'))
            <li {!! Request::is('*createEvent*') ? ' class="active"' : null !!}><a href="{{url('createEvent')}}"><i class="fa fa-circle-o"></i> Create an Event</a></li>
        @endif
        </ul>
    </li>

    <li {!! Request::is('*ember*') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Members</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        @if(Entrust::can('member.read'))
            <li {!! Request::is('*allMembers*') ? ' class="active"' : null !!}><a href="{{url('allMembers')}}"><i class="fa fa-circle-o"></i> All Members</a></li>
        @endif
        @if(Entrust::can('member.create'))
            <li {!! Request::is('*create_member*') ? ' class="active"' : null !!}><a href="{{url('create_member')}}"><i class="fa fa-circle-o"></i> Create a Member</a></li>
        @endif
        @if(Entrust::can('memberType.create'))
            <li {!! Request::is('*addMemberType*') ? ' class="active"' : null !!}><a href="{{url('addMemberType')}}"><i class="fa fa-circle-o"></i> Create a Member Type</a></li>
        @endif
        </ul>
    </li>

    <li {!! Request::is('*roles*') || Request::is('*permissions*') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#">
            <i class="fa fa-gears"></i>
            <span>Settings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @if(Entrust::can('role.readAndcreate'))
                <li {!! Request::is('*roles*') ? ' class="active"' : null !!}><a href="{{url('roles')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
            @endif
            @if(Entrust::can('permission.readAndcreate'))
                <li {!! Request::is('*permissions*') ? ' class="active"' : null !!}><a href="{{url('permissions')}}"><i class="fa fa-circle-o"></i> Permission</a></li>
            @endif                    
        </ul>
    </li>
</ul>
