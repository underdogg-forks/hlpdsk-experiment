@extends('themes.default1.admin.layout.admin')

@section('Staffs')
class="nav-link active"
@stop

@section('staff-menu-parent')
class="nav-item menu-open"
@stop

@section('staff-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('agents')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.agents') }} </h1>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
<ol class="breadcrumb">
</ol>
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')
     <!-- check whether success or not -->
@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas  fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(Session::has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.fails') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
<!-- Warning Message -->
@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissable">
    <i class="fas fa-exclamation-triangle"></i>
    <b>{{ trans('lang.warning') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('warning') }}
</div>
@endif

<div class="card card-light">
    
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.list_of_agents') }} </h3>

        <div class="card-tools">
                    
            <a href="{{route('agents.create')}}" class="btn btn-default btn-tool">
                <span class="fas fa-plus"></span> &nbsp;{{ trans('lang.create_an_agent') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php
        $user = App\User::where('role', '!=', 'user')->orderBy('id', 'ASC')->simplePaginate(10);
        ?>
        <!-- Agent table -->
        <table class="table table-bordered dataTable" style="overflow:hidden;">
            <tr>
                <th width="100px">{{ trans('lang.name') }}</th>
                <th width="100px">{{ trans('lang.user_name') }}</th>
                <th width="100px">{{ trans('lang.role') }}</th>
                <th width="100px">{{ trans('lang.status') }}</th>
                <th width="100px">{{ trans('lang.group') }}</th>
                <th width="100px">{{ trans('lang.department') }}</th>
                <th width="100px">{{ trans('lang.created') }}</th>
                {{-- <th width="100px">{{ trans('lang.lastlogin') }}</th> --}}
                <th width="100px">{{ trans('lang.action') }}</th>
            </tr>
            @foreach($user as $use)
            @if($use->role == 'admin' || $use->role == 'agent')
            <tr>
                <td><a href="{{route('agents.edit', $use->id)}}"> {!! $use->first_name !!} {!! " ". $use->last_name !!}</a></td>
                <td><a href="{{route('agents.edit', $use->id)}}"> {!! $use->user_name !!}</td>
                <?php
                if ($use->role == 'admin') {
                    echo '<td><button class="btn btn-success btn-xs">' . trans('lang.admin') . '</button></td>';
                } elseif ($use->role == 'agent') {
                    echo '<td><button class="btn btn-primary btn-xs">' . trans('lang.agent') . '</button></td>';
                }
                ?>
                <td>
                    @if($use->active=='1')
                    <span style="color:green">{{ trans('lang.active') }}</span>
                    @else
                    <span style="color:red">{{ trans('lang.inactive') }}</span>
                    @endif
                    <?php
                    $group = App\Model\helpdesk\Agent\Groups::whereId($use->assign_group)->first();
                    $department = App\Model\helpdesk\Agent\Department::whereId($use->primary_dpt)->first();
                    ?>
                <td>{{ $group->name }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ UTC::usertimezone($use->created_at) }}</td>
                {{-- <td>{{$use->Lastlogin_at}}</td> --}}
                <td>
                    {!! Form::open(['route'=>['agents.destroy', $use->id],'method'=>'DELETE']) !!}
                    <a href="{{route('agents.edit', $use->id)}}" class="btn btn-primary btn-xs"><i class="fas fa-edit"> </i> {{ trans('lang.edit') }} </a>
                    <!-- To pop up a confirm Message -->
                    {{-- {!! Form::button(' <i class="fas fa-trash"> </i> '  . trans('lang.delete') ,['type' => 'submit', 'class'=> 'btn btn-danger btn-xs','onclick'=>'return confirm("Are you sure?")']) !!} --}}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endif
            @endforeach
        </table>
        <div class="float-right">
            {!! $user->links() !!}
        </div>
    </div>
</div>
@stop
