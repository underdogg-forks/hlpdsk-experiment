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
<h1>{{$teams->name}}</h1>
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

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <b>Success!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(Session::has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>Fail!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif

<?php
 if($team_lead_name= App\User::whereId($teams->team_lead)->first())
          {
            $team_lead = $team_lead_name->first_name . " " . $team_lead_name->last_name;
             // $assign_team_agent=App\Model\helpdesk\Agent\Assign_team_agent::all();
            // $total_members = $assign_team_agent->where('team_id',$id)->count();
        }
?>
            
<div class="card card-light">

    <div class="card-header">
    @if($team_lead_name)
        <h3 class="lead card-title">{{ trans('lang.team_lead') }} : {!! $team_lead !!} </h3>
     @endif
        <h3 class="lead card-title"> &nbsp;| {{ trans('lang.status') }} : <?php if($teams->status == 1) { $stat = trans('lang.active'); } elseif($teams->status == 0) { $stat = trans('lang.inactive'); } ?>{!! $stat !!} </h3>
        
        <div class="card-tools">
            <a href="{{URL::route('teams.index')}}" class="btn btn-default btn-tool">
                <i class="fas fa-arrow-left" aria-hidden="true"></i> {{ trans('lang.go_back') }}
            </a>
        </div>
    </div>
    <input type="hidden" name="show_id" value={{$id}}>
    <!-- /.box-header -->
    <div class="card-body">             
        {!! Datatable::table()
                ->addColumn(
                    trans('lang.user_name'),
                    trans('lang.name'),
                    trans('lang.status'),
                    trans('lang.group'),
                    trans('lang.depertment'),
                    trans('lang.role')
                )
                ->setUrl(route('teams.getshow.list', $id))  // this is the route where data will be retrieved
                ->render() 
        !!}
    </div>
</div>
@stop