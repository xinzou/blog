@extends('admin.layouts.master')
@section('title', '标签列表')
@section('content')
    <script type="text/javascript" src="{{ asset('assets/admin/vendors/teninedialog/jquery/jquery.bootstrap.teninedialog.v3.min.js') }}"></script>
    <script type="text/javascript">
        @if (Session::has('dialog'))
            $.teninedialog({
            title:"{{Session::get('dialog')['title']}}",
            content:"&nbsp;&nbsp;&nbsp;标签名称:{{Session::get('dialog')['message']['name']}}<br/>"
        });
        @endif
        function deleteContent(url,name)
        {
            $.teninedialog({
                title: '系统提示',
                content: '确认删除标签【'+name+'】?',
                //url:'1.txt',
                showCloseButton: true,
                otherButtons: ["确定"],
                otherButtonStyles: ['btn-primary', 'btn-primary'],
                bootstrapModalOption: {
                    keyboard: true
                },
                clickButton: function(sender, modal, index) {
                    if (index == 0) {
                        $('#deletefrom').attr('action', url);
                        $("#deletefrom").submit();
                    }
                    $(this).closeDialog(modal);
                }
            });
        }
    </script>
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
                            <h1>标签列表</h1>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px;text-align:right;">
                    <button class="btn btn-danger" onclick="window.location.href='{{URL::route('webmanagent.tags.create')}}'">+ 增加标签</button>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                {{ $error }}
                            </div>
                        @endforeach
                        @if (Session::has('operationstatus') && Session::get('operationstatus') == 'sucess')
                            <div class="alert alert-success">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                <strong>Success!</strong> 删除标签成功.
                            </div>
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">标签</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>标签ID</th>
                                        <th>标签名</th>
                                        <th>引用次数</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tagsList as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->number}}</td>
                                            <td class="center" style="width:70px;">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:2px 10px;">操作<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ URL::route('webmanagent.tags.edit',$item->id)}}">编辑</a></li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="deleteContent('{{ URL::route('webmanagent.tags.destroy',$item->id)}}','{{$item->name}}')">删除</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="text-align:right;padding;right:10px;">
                                    <?php echo $tagsList->render(); ?>
                                </div>
                                <form method="POST" name="deletefrom" id="deletefrom">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop