<div class="row hot_article">
    <h2>热门文章</h2>
    <ul>
        @foreach($hotArticleList as $item)
            <li><a href="{{URL::action('Website\ArticleController@show', $item->id)}}">{{$item->title}}</a></li>
        @endforeach
    </ul>
</div>
<div class="row">
    <h2>标签云</h2>
    <div id="tagscloud">
        @foreach($tagsList as $item)
            <a href="{{URL::action('Website\TagsController@show', $item->id)}}" class="tagc{{rand(1,3)}}">{{$item->name}}</a>
        @endforeach
    </div>
</div>
<div class="row link_list">
    <h2>友情链接</h2>
    <ul>
        @foreach($linkList as $item)
            <li><a href="{{$item->url}}">{{$item->name}}</a></li>
        @endforeach
    </ul>
</div>