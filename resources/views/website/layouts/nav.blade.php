<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">{{ systemConfig('title') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ systemConfig('title') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($navigationList as $key => $item)
                    @if(empty($item->children))
                        <li><a href="{{$item->url}}">{{$item->name}}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="{{$item->url}}" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">{{$item->name}}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($item->children as $v)
                                    <li><a href="{{$v->url}}">{{$v->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

            <form class="navbar-form pull-right" role="search" action="{{URL::action('Website\SearchController@show')}}" method="get">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-success">搜索</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>