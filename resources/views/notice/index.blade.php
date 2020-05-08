@extends('layout.base')

@section('section')
    <!-- Add Notice Area End Here -->
    <!-- All Notice Area Start Here -->
    <div>
    <div class="col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Notice Board</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-lg-5 col-12 form-group">
                            <input type="text" placeholder="Search by Date ..." class="form-control">
                        </div>
                        <div class="col-lg-5 col-12 form-group">
                            <input type="text" placeholder="Search by Title ..." class="form-control">
                        </div>
                        <div class="col-lg-2 col-12 form-group">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="notice-board-wrap">
                    <div class="notice-list">
                        <div class="post-date bg-skyblue">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School Great School manag mene esom
                                text of the printing Great School manag mene esom  text of the printing manag
                                mene esom  text of the printing.</a></h6>
                        <div class="entry-meta">  Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All Notice Area End Here -->
    </div>
@endsection
