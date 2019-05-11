<div class="form-group searchKhoa" >
                                        <div class="col-sm-9 ">
                                        <label for="ckbSelect"
                                               class="col-sm-1 control-label" style= "margin-top: 15px">Khoa: </label>
                                            <div id="ckbEditSelect" class="margin-top-10 col-sm-6 no-padding-left">
                                                <select class="form-control select2" style="width: 100%;" id="searchKhoa" name="searchKhoa"
                                                        required data-required-error="Chọn bài viết không được trống." placeholder="Chọn khoa">
                                                            <!-- @foreach($Khoa as $key => $val)  -->
                                                                <!-- <option id="{{$val->MaLop}}" value="{{$val->MaLop}}">{{$val->TenKhoa}}</option> -->
                                                                <!-- <option  value="123456">{{$val->TenKhoa}}</option> -->
                                                                <!-- <option id="{{$val->MaKhoa}}" value="{{$val->MaKhoa}}">{{$val->TenKhoa}}</option>
                                                            @endforeach -->
                                                             <!-- <option value="1">thiên ân</option>
                                                            <option value="2" disabled="disabled">thiên â28</option> 
                                                            <option value="2">thiên â22</option>  -->
                                                </select>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>