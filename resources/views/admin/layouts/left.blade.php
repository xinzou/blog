<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <!--权限中心-->
        @if(Session::get('nav')->Top === 'QXZX')
        <li>
            <a href="{{ URL::route('webmanagent.user.index')}}"><i class="glyphicon glyphicon-chevron-down"></i> 用户管理</a>
            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                @if(check_auth('JSLB_INDEX'))
                    <li @if(Session::get('nav')->Left === 'JSLB')class="active"@endif><a href="{{ URL::route('webmanagent.role.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 角色列表</a></li>
                @endif
                @if(check_auth('YHLB_INDEX'))
                    <li @if(Session::get('nav')->Left === 'YHLB')class="active"@endif><a href="{{ URL::route('webmanagent.user.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 用户列表</a></li>
                @endif
            </ul>
        </li>
        <li>
            <a href="{{ URL::route('webmanagent.auth.index')}}"><i class="glyphicon glyphicon-chevron-down"></i> 权限管理</a>
            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                @if(check_auth('QXXX_INDEX'))
                    <li @if(Session::get('nav')->Left === 'QXXX')class="active"@endif><a href="{{ URL::route('webmanagent.auth.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 权限信息</a></li>
                @endif
                @if(check_auth('QXZ_INDEX'))
                    <li @if(Session::get('nav')->Left === 'QXZ')class="active"@endif><a href="{{ URL::route('webmanagent.auth_group.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 权限组</a></li>
                @endif
            </ul>
        </li>
        @endif

        <!--内容管理-->
        @if(Session::get('nav')->Top === 'NRGL')
            <li>
                <a href="{{ URL::route('webmanagent.category.index')}}"><i class="glyphicon glyphicon-chevron-down"></i> 内容管理</a>
                <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                    @if(check_auth('FLGL_INDEX'))
                        <li @if(Session::get('nav')->Left === 'FLGL')class="active"@endif><a href="{{ URL::route('webmanagent.category.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 分类管理</a></li>
                    @endif
                    @if(check_auth('BQGL_INDEX'))
                        <li @if(Session::get('nav')->Left === 'BQGL')class="active"@endif><a href="{{ URL::route('webmanagent.tags.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 标签管理</a></li>
                    @endif
                    @if(check_auth('WZGL_INDEX'))
                        <li @if(Session::get('nav')->Left === 'WZGL')class="active"@endif><a href="{{ URL::route('webmanagent.article.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 文章管理</a></li>
                    @endif
                </ul>
            </li>
        @endif

        <!--系统设置-->
        @if(Session::get('nav')->Top === 'XTSZ')
            <li>
                <a href="{{ URL::route('webmanagent.systems.index')}}"><i class="glyphicon glyphicon-chevron-down"></i> 系统设置</a>
                <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                    @if(check_auth('JBSZ_INDEX'))
                        <li @if(Session::get('nav')->Left === 'JBSZ')class="active"@endif><a href="{{ URL::route('webmanagent.systems.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 基本设置</a></li>
                    @endif
                    @if(check_auth('DHGL_INDEX'))
                        <li @if(Session::get('nav')->Left === 'DHGL')class="active"@endif><a href="{{ URL::route('webmanagent.navigation.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 导航管理</a></li>
                    @endif
                    @if(check_auth('YQLJ_INDEX'))
                        <li @if(Session::get('nav')->Left === 'YQLJ')class="active"@endif><a href="{{ URL::route('webmanagent.links.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 友情链接</a></li>
                    @endif
                </ul>
            </li>
            @endif
        <!--结尾Li-->
    </ul>
</div>