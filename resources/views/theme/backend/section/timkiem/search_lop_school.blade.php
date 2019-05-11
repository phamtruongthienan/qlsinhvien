<div class="form-group">
                                        <div class="col-sm-9 ">
                                        <label for="ckbSelect"
                                               class="col-sm-1 control-label" style= "margin-top: 15px">Lớp: </label>
                                            <div id="ckbEditSelect" class="margin-top-10 col-sm-6 no-padding-left">
                                                <select class="form-control select2" style="width: 100%;" id="searchLop" name="searchLop"
                                                        required data-required-error="Chọn bài viết không được trống.">
                                                            <!-- @foreach($Lop as $key => $val) 
                                                                <option value="{{$val->MaLop}}">{{$val->TenLop}}</option>
                                                            @endforeach -->
                                                            {{-- <option value="1">thiên ân</option>
                                                            <option value="2">thiên â22</option> --}}
                                                </select>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>