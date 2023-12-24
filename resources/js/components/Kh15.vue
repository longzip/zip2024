<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Khách hàng KH15</h3>
                        <div class="card-tools">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" @click="newModal">
                                Thêm KH15
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Tên</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                                <tr v-for="kh15 in kh15s" :key="kh15.id">
                                    <td><a href="#" @click="ttkh15(kh15.id)">{{ kh15.first_name }} {{ kh15.last_name }}</a></td>
                                    <td>{{ kh15.phone }}</td>
                                    <td>{{ kh15.email }}</td>
                                    <td>{{ kh15.address }}, {{ kh15.city }}</td>
                                    <td>{{ kh15.created_at | myDate}}</td>
                                    <td>
                                        <a href="#" @click="editModal(kh15)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(kh15.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="kh15ModalLong" tabindex="-1" role="dialog" aria-labelledby="kh15ModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kh15ModalLongTitle">Thêm khách hàng KH15</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Họ tên</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <select class="form-control" v-model="form.title">
                                                    <option>Anh</option>
                                                    <option>Chị</option>
                                                    <option>Ông</option>
                                                    <option>Bà</option>
                                                </select>
                                            </div>
                                            <div class="col-8">
                                                <input v-model="form.first_name" type="text" class="form-control" placeholder="Họ đệm">
                                            </div>
                                            <div class="col-12 mt-3">
                                                <input v-model="form.last_name" type="text" class="form-control" placeholder="Tên *">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Công ty</label>
                                        <input v-model="form.company" type="text" class="form-control" placeholder="Công ty">
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                    <div class="form-group">
                                        <label>Số điện thoại / Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input v-model="form.phone" type="text" class="form-control" data-inputmask='"mask": "999 999 99 99"' data-mask>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input v-model="form.email" type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Đặc điểm</label>
                                        <input v-model="form.note" type="text" class="form-control" placeholder="Trang phục">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-8">
                                    <label>Địa chỉ</label>
                                    <input v-model="form.address" type="text" class="form-control" placeholder="Địa chỉ">
                                </div>
                                <div class="col-4">
                                    <label>Tỉnh / Thành phố</label>
                                    <select class="form-control" v-model="form.city">
                                        <option>Hoà Bình</option>
                                        <option>Hà Giang</option>
                                        <option>Lào Cai</option>
                                        <option>Phú Thọ</option>
                                        <option>Vĩnh Phúc</option>
                                        <option>Sơn La</option>
                                        <option>Lai Châu</option>
                                        <option>Bắc Giang</option>
                                        <option>Bắc Ninh</option>
                                        <option>Lạng Sơn</option>
                                        <option>Cao Bằng</option>
                                        <option>Tuyên Quang</option>
                                        <option>Thái Nguyên</option>
                                        <option>Bắc Cạn</option>
                                        <option>Yên Bái</option>
                                        <option>Ninh Bình</option>
                                        <option>Hải Phòng</option>
                                        <option>Hải Dương</option>
                                        <option>Hưng Yên</option>
                                        <option>Quảng Ninh</option>
                                        <option>Hà Tây</option>
                                        <option>Nam Định</option>
                                        <option>Hà Nam</option>
                                        <option>Thái Bình</option>
                                        <option>Thanh Hoá</option>
                                        <option>Nghệ An</option>
                                        <option>Hà Tĩnh</option>
                                        <option>Hà Nội</option>
                                        <option>Hồ Chí Minh</option>
                                        <option>Đắc Lắc</option>
                                        <option>Quảng Nam</option>
                                        <option>Đà Nẵng</option>
                                        <option>Quảng Bình</option>
                                        <option>Quảng Trị</option>
                                        <option>Thừa Thiên Huế</option>
                                        <option>Quảng Ngãi</option>
                                        <option>Bình Định</option>
                                        <option>Phú Yên</option>
                                        <option>Khánh Hoà</option>
                                        <option>Gia Lai</option>
                                        <option>Kon Tum</option>
                                        <option>Đồng Nai</option>
                                        <option>Bình Thuận</option>
                                        <option>Lâm Đồng</option>
                                        <option>Bà Rịa - Vũng Tàu</option>
                                        <option>Bình Dương</option>
                                        <option>Bình Phước</option>
                                        <option>Tây Ninh</option>
                                        <option>Đồng Tháp</option>
                                        <option>Ninh Thuận</option>
                                        <option>Vĩnh Long</option>
                                        <option>Cần Thơ</option>
                                        <option>Long An</option>
                                        <option>Tiền Giang</option>
                                        <option>Trà Vinh</option>
                                        <option>Bến Tre</option>
                                        <option>An Giang</option>
                                        <option>Kiên Giang</option>
                                        <option>Cà Mau</option>
                                        <option>Bạc Liêu</option>
                                        <option>Sóc Trăng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea v-model="form.description" type="text" class="form-control" placeholder="Mô tả" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button v-show="!editmode" type="button" @click.prevent="taokh15" class="btn btn-primary">Thêm</button>
                        <button v-show="editmode" type="submit" @click.prevent="updatekh15" class="btn btn-success">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            editmode: false,
            form: new Form({
                id: '',
                title: '',
                first_name: '',
                last_name: '',
                phone: '',
                company: '',
                address: '',
                city: '',
                note: '',
                description: ''
            }),
            kh15s: {}
        }
    },

    methods: {
        editModal(kh15){
            this.editmode = true;
            this.form.reset();
            $('#kh15ModalLong').modal('show');
            this.form.fill(kh15);
        },
        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#kh15ModalLong').modal('show');
        },
        updatekh15(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/kh15/'+this.form.id)
                .then(() => {
                    // success
                    $('#kh15ModalLong').modal('hide');
                     swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
        taokh15() {
            this.$Progress.start();
            this.form.post('api/kh15')
                .then(() => {
                    this.taivekh15();
                    $("#kh15ModalLong").modal("hide");
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        taivekh15() {
            axios.get("api/kh15")
                .then(({ data }) => (this.kh15s = data.data));
        },
        ttkh15(id) {
            var _this = this;
            axios.post("setkh15", {
                    id: id
                })
                .then(response => {
                    location.replace("/thong-tin-kh15")
                })
                .catch(response => {
                    swal("Failed!", 'Liên hệ QA để thông báo lỗi', "warning");
                })
        },
    },
    created() {
        this.taivekh15();
        Fire.$on('AfterCreate',() => {
            this.taivekh15();
        });
    }
}

</script>
