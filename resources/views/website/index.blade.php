@extends('website.layouts.master')
@section('content')
    <div class="jumbotron">
        <h1>{{systemConfig('jum_title')}}</h1><br/>
        <p>{{systemConfig('jum_content')}}</p>
    </div>
    <div class="container col-xs-offset-1">
        <div class="row">
            <div class="col-xs-8">
                @if(!empty(session('msg')))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('msg')}}
                    </div>
                @endif
                <div class="row" style="padding: 10px 40px 10px 5px;font-size: 14px;">
                    <ul>
                    @foreach($articleList as $item)
                        <li style="border-bottom: 1px solid #eee;">
                            <h3><a href="{{URL::action('Website\ArticleController@show', $item->id)}}">{{$item->title}}</a></h3>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;{!! mb_substr(strip_tags($item->content), 0, 100) !!}</p>
                            <p><i class="icon-calendar icon-x"></i> {{$item->created_at}}</p>
                            <br/>
                        </li>
                    @endforeach
                    </ul>
                    <div style="text-align:center;padding;right:10px;">
                        <?php echo $articleList->render(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                @include("website.layouts.right")
            </div>
        </div>
    </div>
@stop