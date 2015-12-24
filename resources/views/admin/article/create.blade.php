@extends('admin.layouts.master')
@section('title', '新增文章')
@section('content')
    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            @include('admin.layouts.left')
                    <!-- content -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1>新增文章</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                {{ $error }}
                            </div>
                        @endforeach
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">文章</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('webmanagent.article.store')}}" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="title">文章标题</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="title" name="title" type="text" value="@if (!empty(Session::get('title'))){{Session::get('title')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="cate_id">所属分类</label>
                                            <div class="col-lg-4">
                                                <select id="cate_id" name="cate_id" class="form-control" style="width: 150px">
                                                    @foreach($categoryTreeList as $key => $val)
                                                        <option value="{{$key}}"@if (Session::get('cate_id') === $val) selected="true"@endif>{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="tags">标签</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="tags" name="tags" type="text" value="@if (!empty(Session::get('tags'))){{Session::get('tags')}}@endif">
                                            </div>
                                            <p class="text-info">可以设置多个标签，请以“,”间隔。如：a,b</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="tags"></label>
                                            <div class="col-lg-6">
                                                <p>标签列表</p>
                                                <select multiple class="form-control" id="tagList" style="height: 100px;" onchange="selectTags()">
                                                    @foreach($tagsList as $key => $val)
                                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-info">点击选择标（可多选）</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="pic">封面图片</label>
                                            <div class="col-lg-4">
                                                <input type="file" id="pic" name="pic">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="content">内容</label>
                                            <div class="col-lg-10">
                                                <textarea id="content" name="content" >@if (!empty(Session::get('content'))){{Session::get('content')}}@endif</textarea>
                                            </div>
                                        </div>
                                        <div style="padding-left:90px;">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                            <button type="reset" class="btn btn-default">取消</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'zh_CN',
            language_url: '{{ asset('plugins/tinymce/langs/zh_CN.js') }}',
            height: 500,
            theme: 'modern',
            plugins: [
                'filemanager advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image filemanager',
            toolbar2: 'print preview media | forecolor backcolor emoticons | fullscreen codesample',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            relative_urls : false
        });

        function selectTags()
        {
            var selectTag = '';
            if($("#tags").val() === '')
            {
                selectTag = $("#tagList").find("option:selected").text();
            }
            else {
                selectTag = ","+$("#tagList").find("option:selected").text();
            }
            $("#tags").val($("#tags").val()+selectTag);
        }
    </script>
    <style>
        div.mce-fullscreen{
            top:80px;
        }
    </style>
@stop