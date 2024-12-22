@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalActive }}</h3>

                <p>Total Users Active</p>
              
              <div class="icon">
                <i class="fas fa-user-check"></i>
              </div>
                
              </div>
              <a href="{{url('radcheck?status=enabled')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalInactive }}</h3>

                <p>Total Users Inactive</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-times"></i>
              </div>

              <a href="{{ url('radcheck?status=disabled') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
    </div>
          </div>
          <!-- ./col -->
        </div>
    </div>
@endsection
