<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div v-show="!editmode" class="card-header">Thêm khách hàng tiềm năng</div>
                    <div v-show="editmode" class="card-header">Sửa khách hàng tiềm năng</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Chức danh</label>
                                <select class="form-control" v-model="contact.title">
                                    <option disabled value="">Chọn</option>
                                    <option>Anh</option>
                                    <option>Chị</option>
                                    <option>Ông</option>
                                    <option>Bà</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Họ đệm</label>
                                <input v-model="contact.first_name" type="text" class="form-control" placeholder="Họ đệm">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tên</label>
                                <input v-model="contact.last_name" type="text" class="form-control" placeholder="Tên *">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Công ty</label>
                                <input v-model="contact.company" type="text" class="form-control" placeholder="Công ty">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Số điện thoại</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input v-model="contact.phone" type="text" class="form-control" data-inputmask='"mask": "999 999 99 99"' data-mask>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input v-model="contact.email" type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Đặc điểm (nhận dạng)</label>
                                <input v-model="contact.note" type="text" class="form-control" placeholder="Trang phục">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Địa chỉ</label>
                                <input v-model="contact.address" type="text" class="form-control" placeholder="Địa chỉ">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tỉnh / Thành phố</label>
                                <multiselect v-model="contact.city" :options="options.city" placeholder="Chọn"></multiselect>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Khu vực</label>
                                <multiselect v-model="value_categories" deselect-label="Can't remove this value" track-by="id" label="name" placeholder="Chọn khu vực" :options="options_categories" :searchable="true" :allow-empty="false">
                                </multiselect>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Showroom</label>
                                <multiselect v-model="value_costcenters" deselect-label="Can't remove this value" track-by="code" label="name" placeholder="Chọn Showroom" :options="options_costcenters" :searchable="true" :allow-empty="false">
                                </multiselect>
                            </div>
                        </div>
<!--                         <br>
                        <h5 class="card-title">Đặc điểm của khách hàng tiềm năng</h5>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Nhà</label>
                                <select class="form-control" v-model="contact.accommodation">
                                    <option disabled value="">Chọn</option>
                                    <option>Chung cư</option>
                                    <option>Nhà riêng</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Có ở cùng bố mẹ</label>
                                <select class="form-control" v-model="contact.parents">
                                    <option disabled value="">Chọn</option>
                                    <option>Có</option>
                                    <option>Không</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Bao nhiêu con</label>
                                <input class="form-control" v-model="contact.children" type="number" name="">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Có ở chung phòng không</label>
                                <select class="form-control" v-model="contact.share">
                                    <option disabled value="">Chọn</option>
                                    <option>Có</option>
                                    <option>Không</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Có mang việc về nhà không</label>
                                <select class="form-control" v-model="contact.homework">
                                    <option disabled value="">Chọn</option>
                                    <option>Có</option>
                                    <option>Không</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Hay tiếp khách ở nhà không</label>
                                <select v-model="contact.reception" class="form-control">
                                    <option disabled value="">Chọn</option>
                                    <option>Có</option>
                                    <option>Không</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Đặc điểm khác</label>
                                <input v-model="contact.other_note" type="text" class="form-control" placeholder="Nhập đặc điểm khác"></input>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Khu vực</label>
                                <multiselect v-model="value_categories" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="id" :options="options_categories" :multiple="true" :taggable="true"></multiselect>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Showroom</label>
                                <multiselect v-model="value_costcenters" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options_costcenters" :multiple="true" :taggable="true"></multiselect>
                            </div>
                        </div>
                        <br>
                        <h5 class="card-title">Thông tin lo lắng của khách hàng</h5>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Giá</label>
                                <input v-model="contact.llgia" type="text" class="form-control" placeholder="Nhập lo lắng về giá">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Gỗ</label>
                                <input v-model="contact.llgo" type="text" class="form-control" placeholder="Nhập lo lắng về gỗ">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Cơ khí</label>
                                <input v-model="contact.llcokhi" type="text" class="form-control" placeholder="Nhập lo lắng về cơ khí">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Màu sắc</label>
                                <input v-model="contact.llmausac" type="text" class="form-control" placeholder="Nhập lo lắng về màu sắc">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Kích thước</label>
                                <input v-model="contact.llkichthuoc" type="text" class="form-control" placeholder="Nhập lo lắng về kích thước">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Không gian phòng</label>
                                <input v-model="contact.llphong" type="text" class="form-control" placeholder="Nhập lo lắng về không gian phòng">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Bảo hành</label>
                                <input v-model="contact.llbaohanh" type="text" class="form-control" placeholder="Nhập lo lắng về bảo hành">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Lắp đặt, vận chuyển</label>
                                <input v-model="contact.llld_vc" type="text" class="form-control" placeholder="Nhập lo lắng về lắp đặt, vận chuyển">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Lo lắng khác</label>
                                <input v-model="contact.llkhac" type="text" class="form-control" placeholder="Nhập lo lắng khác của khách">
                            </div>
                        </div> -->
                        <br>
                        <h5 class="card-title">Ghi chú</h5>
                        <div class="form-group">
                            <textarea v-model="contact.description" type="text" class="form-control" placeholder="Nhập ghi chú về khách hàng tiềm năng"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/khach-tiem-nang" class="btn">Hủy</a>
                        <button v-show="!editmode" @click.prevent="addcontact" class="btn btn-primary">Thêm</button>
                        <button v-show="editmode" @click.prevent="savecontact" class="btn btn-primary">Lưu</button>
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
            value: [
                { name: 'Javascript', code: 'js' }
            ],
            value_categories: [],
            value_costcenters: [],
            options_categories: [
                { name: 'Javascript', id: 'js' },
            ],
            options_costcenters: [
                { name: 'Javascript', id: 'js' },
            ],
            contact: {
                id: '',
                title: '',
                first_name: '',
                last_name: '',
                phone: '',
                email: '',
                company: '',
                address: '',
                city: '',
                note: '',
                //đặc điểm khách hàng tiềm năng & kh15
                accommodation: '',
                parents: '',
                children: '',
                share: '',
                homework: '',
                reception: '',
                other_note: '',
                //lo lắng khách hàng tiềm năng
                llgia: '',
                llgo: '',
                llcokhi: '',
                llmausac: '',
                llkichthuoc: '',
                llphong: '',
                llbaohanh: '',
                llld_vc: '',
                llkhac: '',
                description: '',

            },
            options: {
                target: [
                    'Giá',
                    'Gỗ',
                    'Cơ khí',
                    'Màu sắc',
                    'Kích thước',
                    'Không gian phòng',
                    'Bảo hành',
                    'Lắp đặt vận chuyển',
                    'Khác'
                ],
                city: [
                    'Hà Giang',
                    'Lào Cai',
                    'Phú Thọ',
                    'Vĩnh Phúc',
                    'Sơn La',
                    'Lai Châu',
                    'Bắc Giang',
                    'Bắc Ninh',
                    'Lạng Sơn',
                    'Cao Bằng',
                    'Tuyên Quang',
                    'Thái Nguyên',
                    'Bắc Cạn',
                    'Yên Bái',
                    'Ninh Bình',
                    'Hải Phòng',
                    'Hải Dương',
                    'Hưng Yên',
                    'Quảng Ninh',
                    'Hà Tây',
                    'Nam Định',
                    'Hà Nam',
                    'Thái Bình',
                    'Thanh Hoá',
                    'Nghệ An',
                    'Hà Tĩnh',
                    'Hà Nội',
                    'Hồ Chí Minh',
                    'Đắc Lắc',
                    'Quảng Nam',
                    'Đà Nẵng',
                    'Quảng Bình',
                    'Quảng Trị',
                    'Thừa Thiên Huế',
                    'Quảng Ngãi',
                    'Bình Định',
                    'Phú Yên',
                    'Khánh Hoà',
                    'Gia Lai',
                    'Kon Tum',
                    'Đồng Nai',
                    'Bình Thuận',
                    'Lâm Đồng',
                    'Bà Rịa - Vũng Tàu',
                    'Bình Dương',
                    'Bình Phước',
                    'Tây Ninh',
                    'Đồng Tháp',
                    'Ninh Thuận',
                    'Vĩnh Long',
                    'Cần Thơ',
                    'Long An',
                    'Tiền Giang',
                    'Trà Vinh',
                    'Bến Tre',
                    'An Giang',
                    'Kiên Giang',
                    'Cà Mau',
                    'Bạc Liêu',
                    'Sóc Trăng'
                ]
            }
        }
    },

    methods: {
        loadcontact() {
            axios.get("/getcontact")
                .then(response => {
                    this.contact = response.data;
                    this.editmode = true;
                })
                .catch(response => {
                    this.editmode = false;
                })
        },
        loadcostcenters() {
            axios.get("/api/costcenters/all")
                .then(response => {
                    this.options_costcenters = response.data;
                })
        },
        loadcategories() {
            axios.get("api/getallcategories")
                .then(response => {
                    this.options_categories = response.data;
                })
        },
        addcontact() {
            axios.post("/api/contacts", this.contact)
                .then(response => {
                    location.replace("/khach-tiem-nang")
                })
                .catch(response => {
                    swal.fire("Failed!", 'Liên hệ IT Zalo(037 463 86 03) để thông báo lỗi', "warning");
                })
        },
        savecontact() {
            //this.contact.costcenter = this.contact.costcenter.id;
            //this.contact.categories = this.contact.categories.id;
            axios.put("/api/contacts/" + this.contact.id, this.contact)
                .then(response => {
                    location.replace("/khach-tiem-nang")
                })
                .catch(response => {
                    swal.fire("Failed!", 'Liên hệ QA để thông báo lỗi', "warning");
                })
        },
    },
    created() {
        this.loadcontact();
        this.loadcostcenters();
        this.loadcategories();
    }
}

</script>
