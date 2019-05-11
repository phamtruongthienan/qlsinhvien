<!-- Add modal customer -->
<div class="modal fade" id="modal-level" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span id="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        {{-- @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                                <li class="active"><a href="#" class="tab_edit_level" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a href="#" class="tab_edit_level" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach --}}
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="LevelForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="name"
                                           class="col-sm-3 control-label">Mã lớp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addMaLop" name="addMaLop" value=""
                                               required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name"
                                           class="col-sm-3 control-label">Tên lớp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addTenLop" name="addTenLop" value=""
                                               required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ckbSelect"
                                           class="col-sm-3 control-label">Khoa</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <div id="ckbEditSelect" class="margin-top-10 col-sm-6 no-padding-left">
                                            <select class="form-control select2" style="width: 100%;" id="addMaKhoa" 
                                            name="addMaKhoa"
                                                    required data-required-error="Chọn bài viết không được trống.">
                                                        @foreach($Khoa as $key => $val) 
                                                            <option value="{{$val->MaKhoa}}">{{$val->TenKhoa}}</option>
                                                        @endforeach
                                            </select>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="LevelBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->