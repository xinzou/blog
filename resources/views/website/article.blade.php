@extends('website.layouts.master')
@section('content')
    <div class="jumbotron">
        <h1>{{$article->title}}</h1><br/>
        <p><i class="icon-calendar icon-x"></i> {{$article->created_at}}</p>
        <p>{!! mb_substr(strip_tags($article->content), 0, 40) !!}}</p>
    </div>
    <div class="container col-xs-offset-1">
        <div class="row">
            <div class="col-xs-8">
                <div class="row" style="padding: 10px 40px 10px 5px;font-size: 14px;">
                    <p>{!!$article->content!!}</p>
                    <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                    <div class="comments" class="row">
                        <div id="disqus_thread" class="row"></div>
                        <script type="text/javascript">
                            var disqus_shortname = "{{ config('site.disqus_shortname') }}";
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the &lt;a href="http://disqus.com/?ref_noscript"&gt;comments powered by Disqus.&lt;/a&gt;</noscript>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                @include("website.layouts.right")
            </div>
        </div>
    </div>
@stop