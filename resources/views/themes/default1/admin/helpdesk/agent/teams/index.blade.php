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

@section('teams')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.teams') }}</h1>
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
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa  fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>Fail!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">

    <div class="card-header">
        
        <h3 class="card-title">{{ trans('lang.list_of_teams') }}</h3>

        <div class="card-tools">
            
            <a href="{{route('teams.create')}}" class="btn btn-default btn-tool">
                <span class="fas fa-plus"></span>&nbsp;{{ trans('lang.create_team') }}
            </a>        
        </div>
    </div>
    
    <div class="card-body">
      
        <table class="table table-bordered dataTable" style="overflow:scroll;">
            <tr>
                <th>{{ trans('lang.name') }}</th>
                <th>{{ trans('lang.status') }}</th>
                <th>{{ trans('lang.team_members') }}</th>
                <th>{{ trans('lang.team_lead') }}</th>
                <th>{{ trans('lang.action') }}</th>
            </tr>
            @foreach($teams as $team)
            <tr>
                <td><a href="{{route('teams.show', $team->id)}}"> {{$team->name }}</a></td>
                <td>
                    @if($team->status=='1')
                    <span style="color:green">{{ trans('lang.active') }}</span>
                    @else
                    <span style="color:red">{{ trans('lang.inactive') }}</span>
                    @endif
                    <?php
                    if ($team->team_lead == 0) {
                        $team_lead = "";
                    } else {
                        $users = App\User::whereId($team->team_lead)->first();
                        $team_lead = $users->full_name;
                    }
                    ?>
                </td>
                <td>{{count($assign_team_agent->where('team_id',$team->id))}}</td>
                <td>{{ $team_lead }}</td>
                <td>
                    <form method="POST" action="{{ route('teams.destroy', $team->id) }}">
    @csrf
    @method('DELETE')

                    <!-- To pop up a confirm Message -->
                   @if ($team->status == 0) 
                    <a href="{{route('teams.show', $team->id)}}" class="btn btn-success btn-xs" disabled='disabled'><i class="fas fa-eye"> </i> {{ trans('lang.show') }}</a>
                    
                    @endif
                     @if ($team->status == 1) 
                    <a href="{{route('teams.show', $team->id)}}" class="btn btn-success btn-xs" ><i class="fas fa-eye"> </i> {{ trans('lang.show') }}</a>
                    
                    @endif

                    <a href="{{route('teams.edit', $team->id)}}" class="btn btn-primary btn-xs"><i class="fas fa-edit"> </i> {{ trans('lang.edit') }}</a>
                    
                    {!! Form::button('<i class="fas fa-trash"> </i> '.trans('lang.delete'),
                    ['type' => 'submit',
                    'class'=> 'btn btn-danger btn-xs',
                    'onclick'=>'return confirm("Are you sure?")'])
                    !!}
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@stop