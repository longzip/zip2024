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
                                <label>Đặc điểm (nhận dạng)1</label>
                                <input v-model="contact.note" type="text" class="form-control" placeholder="Trang phục">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Khu vực</label>
                                <multiselect v-model="contact.category" deselect-label="Can't remove this value" track-by="id" label="name" placeholder="Select one" :options="options_categories" :searchable="false" :allow-empty="false">
                                </multiselect>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Showroom</label>
                                <multiselect v-model="contact.costcenter" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one" :options="costcenters" :searchable="false" :allow-empty="false">
                                </multiselect>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ngày</label>
                                <input v-model="contact.start_date" type="date" class="form-control" placeholder="Trang phục">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Giờ vào</label>
                                <input class="form-control" type="time" v-model="contact.start_time">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Giờ ra</label>
                                <input class="form-control" type="time" v-model="contact.end_time">
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
                        </div>
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
            costcenters: [],
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
                email: '',
                phone: '',
                company: '',
                address: '',
                city: '',
                description: '',
                start_date: '',
                start_time: '',
                end_time: ''
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
        chonKhuVuc(selectedOption) {
            //this.contact.category = selectedOption;
        },
        loadcontact() {
            axios.get("/getcontact")
                .then(response => {
                    this.contact = response.data;
                    this.editmode = true;
                    this.contact.category = this.contact.category[0];
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
            axios.post("/api/contacts", {
                    title: this.contact.title,
                    first_name: this.contact.first_name,
                    last_name: this.contact.last_name,
                    email: this.contact.email,
                    phone: this.contact.phone,
                    company: this.contact.company,
                    address: this.contact.address,
                    city: this.contact.city,
                    description: this.contact.description,
                    start_date: this.contact.start_date,
                    start_time: this.contact.start_time,
                    end_time: this.contactend_time,
                    categories: this.contact.category,
                    costcenter: this.contact.costcenter
                })
                .then(response => {
                    location.replace("/khach-tiem-nang")
                })
                .catch(response => {
                    swal.fire("Failed!", 'Liên hệ IT Zalo(037 463 86 03) để thông báo lỗi', "warning");
                })
        },
        savecontact() {
            axios.put("/api/contacts/" + this.contact.id, {
                    title: this.contact.title,
                    first_name: this.contact.first_name,
                    last_name: this.contact.last_name,
                    email: this.contact.email,
                    phone: this.contact.phone,
                    company: this.contact.company,
                    address: this.contact.address,
                    city: this.contact.city,
                    description: this.contact.description,
                    start_date: this.contact.start_date,
                    start_time: this.contact.start_time,
                    end_time: this.contactend_time,
                    categories: this.contact.category.id
                })
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
        this.loadcategories();
        Fire.$on('AfterCreateCategory', () => {
            this.loadcategories();
            this.contact.category = this.category;
        });
        axios.get('/api/picklists/costcenter-picklists')
            .then(res => this.costcenters = res.data);
    }
}

</script>
