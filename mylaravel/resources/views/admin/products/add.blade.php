@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm sản phẩm</h3>

                    <div class="box-tools pull-right">
                        {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> --}}
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form method="POST" action="{{ route('admin.products.add.post') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        @include('includes.message')
                        <div class="form-group @if ($errors->has('name')) has-error @endif ">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Tên tài khoản">
                        </div>
                        <div class="form-group @if ($errors->has('category_id')) has-error @endif ">
                            <label for="exampleInputEmail1">Danh mục</label>
                            <select class="form-control select2" name="category_id" style="width:100%">
                                @foreach ($categorys as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == old('category_id')) selected @endif>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group @if ($errors->has('number')) has-error @endif ">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}"
                                placeholder="Nhập số lượng">
                        </div>
                        <div class="form-group @if ($errors->has('price')) has-error @endif ">
                            <label for="exampleInputEmail1">Giá tiền</label>
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}"
                                placeholder="Nhập giá tiền">
                        </div>
                        <div class="form-group @if ($errors->has('status_hight_light')) has-error @endif ">
                            <label for="exampleInputEmail1">Sản phẩm top</label>
                            </br>
                            <input type="checkbox" name="status_hight_light" value="1" @if (old('status_hight_light') == 1) checked @endif>

                        </div>
                        <div class="form-group @if ($errors->has('img')) has-error @endif ">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" class="form-control" name="img[]" id="file-input" multiple>
                            <div id="preview"></div>
                        </div>
                        <div class="form-group @if ($errors->has('description')) has-error @endif ">
                            <label for="exampleInputEmail1">Mô tả</label>
                            </br>
                            <textarea name="description" id="editor1" cols="153" rows="5">
                                                {{ old('description') }}
                                            </textarea>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </form>
                <!-- /.box -->
            </div>
        </div>
        <script>
            $(document).ready(function() {
                CKEDITOR.replace('editor1');
                function previewImages() {
                    var $preview = $('#preview').empty();
                    if(this.files)$.each(this.files,readAndPreview);
                    function readAndPreview(i, file) {
                        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                            return alert(file.name + " is not an image");
                        } //else
                         
                         var reader = new FileReader();

                         $(reader).on("load",function() {
                             $preview.append($("<img/>",{src:this.result,height:100}));
                         });

                         reader.readAsDataURL(file);

                    }
                }
                $('#file-input').on("change",previewImages);
            });
        </script>
    @stop
