<template>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <a class="" href="#" @click="editcontact(contact.id)">
                            <h3 class="profile-username text-center">{{ contact.first_name}} {{ contact.last_name}}</h3>
                        </a>
                        <p class="text-muted text-center">{{ contact.company}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>{{ contact.address}}</b> <a class="float-right">{{ contact.city}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a class="float-right">{{ contact.phone}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ contact.email}}</a>
                            </li>
                        </ul>
                        <a href="#" @click="editcontact(contact.id)" class="btn btn-primary btn-block">Sửa thông tin</a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <div class="col-md-9">
                <tabs>
                    <tab name="Đặc điểm">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Các đặc điểm Kh15</div>
                            </div>
                            <div class="card-body" v-for="kh15 in kh15s" :key="kh15.id">
                                <strong><i class="fas fa-check"></i> {{kh15.name}}</strong>
                                <p class="text-muted">{{kh15.description}}</p>
                                <strong>Thêm bởi: </strong><small>{{kh15.user_name}}</small>
                            </div>
                            <div class="card-footer">
                                <form class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="seclectKh15" class="sr-only">Chọn</label>
                                        <multiselect id="seclectKh15" v-model="kh15.name" :options="kh15Types" placeholder="Chọn đặc điểm"></multiselect>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputDescription" class="sr-only">Nhập</label>
                                        <input v-model="kh15.description" type="text" class="form-control" id="inputDescription" placeholder="Mô tả">
                                    </div>
                                    <button @click.prevent = "addKh15" type="submit" class="btn btn-primary mb-2">Thêm đặc điểm</button>
                                </form>
                            </div>
                        </div>
                    </tab>
                    <tab name="Lo lắng">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Các lo lắng</div>
                            </div>
                            <div class="card-body" v-for="lost in losts" :key="lost.id">
                                <strong><i class="fas fa-check"></i> {{lost.name}}</strong>
                                <p class="text-muted">{{lost.description}}</p>
                                <strong>Thêm bởi: </strong><small>{{lost.user_name}}</small>
                            </div>
                            <div class="card-footer">
                                <form class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="seclectLost" class="sr-only">Chọn</label>
                                        <multiselect id="seclectLost" v-model="lost.name" :options="lostTypes" placeholder="Chọn đặc điểm"></multiselect>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputDescription" class="sr-only">Nhập</label>
                                        <input v-model="lost.description" type="text" class="form-control" id="inputDescription" placeholder="Mô tả">
                                    </div>
                                    <button @click.prevent="addLost" type="submit" class="btn btn-primary mb-2">Thêm lo lắng</button>
                                </form>
                            </div>
                        </div>
                    </tab>
                    <tab name="Tư vấn">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Bảng kế hoạch</div>
                            </div>
                            <div class="card-body">
                                <ul class="timeline">
                                    <li v-for="task in tasks" :key="task.id">
                                        <i>{{task.priority}}</i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> {{task.created_at | myDate}}</span>
                                            <h3 class="timeline-header">{{task.title}} </h3>
                                            <div class="timeline-body">
                                                Gán cho: {{task.user_name}}<br>
                                                Đến: {{task.duedate | myDate}}<br>
                                                Trạng thái: {{task.completed | completed}}<br>

                                                {{task.task}}
                                            </div>
                                            <div class="timeline-footer">
                                                <a v-show="!task.completed" @click="taskCompleted(task)" href="#" class="btn btn-primary btn-sm">Hoàn thành</a>
                                                
                                <a v-show="!task.completed" href="#" @click="deleteTask(task)" class="btn btn-danger btn-sm">Hủy</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal">
                                    Tạo kế hoạch
                                </button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Các hoạt động</div>
                            </div>
                            <div class="card-body">
                                <div v-for="activity in activities" :key="activity.id" class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="/img/man.png" alt="user image">
                                        <span class="username">
                                            <a href="#">{{activity.subject}}</a>
                                            <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                                        </span>
                                        <span class="description">{{activity.user_name}} - {{activity.date_start | myDate}} {{activity.time_start}}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{activity.note}}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-primary" @click="showmodelaction()" tabindex="-1" href="#">Tạo hoạt động</a>
                            </div>
                        </div>
                    </tab>
                    <tab name="Bình luận">
                        <div class="card card-widget">
                            <div v-for="comment in comments" class="card-footer card-comments">
                                <div class="card-comment">
                                    <img class="img-circle img-sm" src="/img/man.png" alt="User Image">
                                    <div class="comment-text">
                                        <span class="username">
                                            {{comment.title}}
                                            <span class="text-muted float-right">{{comment.created_at | myDateTime}}</span>
                                        </span><!-- /.username -->
                                        {{comment.body}}
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                            </div>
                            <!-- /.card-footer -->
                            <div class="card-footer">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <textarea v-model="comment.body" class="form-control form-control" placeholder="Nội dung bình luận"></textarea>
                                    <button @click.prevent="contactstorecomment" class="btn btn-primary">Gửi bình luận</button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </tab>
                    <tab name="Tài liệu">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách tài liệu khách hàng</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Tên tài liệu</th>
                                            <th>Đownload</th>
                                            <th>Ngày tạo</th>
                                        </tr>
                                        <tr v-for="attachmen in attachmens">
                                            <td>{{attachmen.name}}</td>
                                            <td><a href="#" @click="download(attachmen.id)">{{attachmen.file_name}}</a></td>
                                            <td>{{attachmen.created_at | myDate}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <label>Chọn
                                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
                                </label>
                                <button v-on:click="submitFile()">Upload</button>
                            </div>
                        </div>
                    </tab>
                    <!-- Quote -->
                    <tab name="Báo giá">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Danh sách báo giá</div>
                                <div class="card-tools">
                                    <a class="btn btn-primary" tabindex="-1" href="/bao-gia">Thêm báo giá</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Báo giá</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng tiền</th>
                                                <th>Phí VC</th>
                                                <th>Phí LĐ</th>
                                                <th>Giảm giá</th>
                                                <th>Thanh toán</th>
                                                <th>Ngày báo giá</th>
                                            </tr>
                                            <tr v-for="quote in quotes" :key="quote.id">
                                                <td><a href="#" @click="showquote(quote)">{{quote.subject}}</a></td>
                                                <td>{{quote.quotestage}}</td>
                                                <td>{{quote.subtotal}}</td>
                                                <td>{{quote.fee_vc}}</td>
                                                <td>{{quote.fee_ld}}</td>
                                                <td>{{quote.discount_amount}}</td>
                                                <td>{{quote.total}}</td>
                                                <td>{{quote.created_at | myDate}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <!-- /.card-footer -->
                            <div class="card-footer">
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </tab>
                    <!-- Videos -->
                    <tab name="Videos">
                        <div class="card">
                            <div class="card-footer">
                                <div class="card-body" v-for="item in youtubes" :key="item.id">
                                    <iframe id="video_youtube" v-bind:src="'https://www.youtube.com/embed/' + item.title" width="360" height="auto" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="form-group">
                                    <input v-model="youtube_id" type="text" class="form-control" placeholder="Nhập ID videos Youtube">
                                    <button class="btn btn-primary" @click.prevent="themvideo">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </tab>
                </tabs>
            </div>
        </div>
        <!-- Button trigger modal -->
        <!-- Modal Task-->
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tạo kế hoạch mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Chọn loại hoạt động</label>
                            <multiselect v-model="taskcontact.title" :options="activityTypes" label="name" track-by="name" placeholder="Chọn hoạt động"></multiselect>
                        </div>
                        <div class="form-group">
                            <label>Nội dung kế hoạch</label>
                            <textarea v-model="taskcontact.task" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Bước</label>
                            <select v-model="taskcontact.priority" class="form-control">
                                <option>Bước 1</option>
                                <option>Bước 2</option>
                                <option>Bước 3</option>
                                <option>Bước 4</option>
                                <option>Bước 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thực hiện</label>
                            <multiselect v-model="taskcontact.user" :options="users" label="name" track-by="id" placeholder="Chọn người thực hiện"></multiselect>
                        </div>
                        <div class="form-group">
                            <label>Ngày hoàn thành</label>
                            <input v-model="taskcontact.duedate" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" @click.prevent="taokehoach" class="btn btn-primary">Tạo kế hoạch</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actionModalLabel">Tạo hoạt động</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label>Chọn loại hoạt động</label>
                                <multiselect v-model="activity.subject" :options="activityTypes" label="name" track-by="name" placeholder="Chọn hoạt động"></multiselect>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Từ:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input v-model="activity.date_start" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                            <input v-model="activity.time_start" type="time" class="form-control timepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                    <div class="form-group">
                                        <label>Đến:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input v-model="activity.due_date" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                            <input v-model="activity.time_end" type="time" class="form-control timepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                            <!-- select -->
                            <!--                             <div class="form-group">
                                <label>Trạng thái</label>
                                <select v-model="activity.status" class="form-control">
                                    <option>Chưa bắt đầu</option>
                                    <option>Đang thực hiện</option>
                                    <option>Hoàn thành</option>
                                    <option>Lên kế hoạch</option>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea v-model="activity.note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" @click.prevent="taohanhdong" class="btn btn-primary">Tạo</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal  fade" id="quoteLineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{quote.subject}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row invoice-info">
                            <div class="col-sm-6 invoice-col">
                                To
                                <address>
                                    <strong>{{ contact.first_name}} {{ contact.last_name}}</strong><br>
                                    {{ contact.address}} {{ contact.city}}<br>
                                    Điện thoại: {{ contact.phone}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                                <strong></strong><br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>SL</th>
                                            <th>Đơn giá</th>
                                            <th>CK</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in quoteitems">
                                            <td>{{ item.product_id }}</td>
                                            <td>{{ item.quantity }}</td>
                                            <td>{{ item.listprice | currency }}</td>
                                            <td>{{ item.discount_percent | currency}}</td>
                                            <td>{{ item.amount | currency }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Tình trạng: </th>
                                                <td style="width:50%">{{quote.quotestage}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Ngày tạo: </th>
                                                <td style="width:50%">{{quote.created_at | myDate}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Giảm giá</th>
                                                <td>{{quote.qgg | currency}}</td>
                                            </tr>
                                            <tr>
                                                <th>Phí lắp đặt</th>
                                                <td>{{quote.fee_ld | currency}}</td>
                                            </tr>
                                            <tr>
                                                <th>Phí vận chuyển</th>
                                                <td>{{quote.fee_vc | currency}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tổng tiền</th>
                                                <td>{{quote.subtotal | currency}}</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td>{{quote.vat | currency}}</td>
                                            </tr>
                                            <tr>
                                                <th>Thanh toán</th>
                                                <td>{{quote.amount | currency}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row no-print">
                            <div class="col-12">
                                <a id="print" href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                <button @click="duyetDonHang(quote.id)" type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Chuyển đơn hàng
                                </button>
                                <a id="downloadExcel" href="#" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fa fa-download"></i> Tải xuống
                                </a>
                            </div>
                        </div>
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
            contact: {},
            activities: {},
            quotes: {},
            quote: {},
            quoteitems: {},
            comments: {},
            comment: {
                body: ''
            },
            tasks: {},
            taskcontact: {
                contact_id: '',
                user: '',
                title: '',
                task: '',
                priority: '',
                duedate: '',
            },
            activity: {
                subject: '',
                date_start: '',
                due_date: '',
                time_start: '',
                time_end: '',
                status: '',
                note: '',
            },

            file: '',
            attachmens: [],
            task: null,
            youtubes: [],
            youtube_id: '',
            user: {},
            kh15:{
                name: '',
                description: ''
            },
            kh15s: {},
            lost: {
                name: '',
                description: ''
            },
            losts: {},

            //picklist
            users: [],
            activityTypes: [],
            coscenters: [],
            kh15Types: [
                'Nhà chung cư',
                'Nhà riêng',
                'Không gian',
                'Bảo hành',
                'Vận chuyển',
            ],
            lostTypes: [
                'Giá',
                'Kích thước',
                'Không gian',
                'Bảo hành',
                'Vận chuyển',
            ],
        }
    },
    methods: {
        /*
        Submits the file to the server
      */
        submitFile() {
            /*
                    Initialize the form data
                */
            let formData = new FormData();

            /*
                Add the form data we need to submit
            */
            formData.append('file', this.file);

            /*
              Make the request to the POST /single-file URL
            */
            axios.post('api/contacts/attachmens/' + this.contact.id,
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    this.attachmens = response.data;
                })
                .catch(function() {
                    console.log('FAILURE!!');
                });
        },

        /*
          Handles a change on the file upload
        */
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        loadcontact() {
            this.$Progress.start();
            axios.get("getcontact")
                .then(response => {
                    this.contact = response.data;
                    this.loadcomments();
                    this.taivehoatdong();
                    this.loadattachmens();
                    this.taivekehoach();
                    this.loadVideos();
                    this.loadKh15s();
                    this.loadLosts();
                    this.$Progress.finish();
                })
                .catch(() => {
                    location.replace("/khach-tiem-nang")
                    this.$Progress.fail();
                });
        },
        loadquotes() {
            axios.get("/quotebycontact")
                .then(response => {
                    this.quotes = response.data;
                })
        },
        loadActivityTypes() {
            axios.get("/api/picklists/activity-types")
                .then(response => {
                    this.activityTypes = response.data;
                })
        },
        loadVideos() {
            axios.get("/api/contacts/videos/" + this.contact.id)
                .then(response => {
                    this.youtubes = response.data;
                })
        },
        showquote(quote) {
            this.quote = quote;
            axios.get("quoteitems/" + quote.id)
                .then(response => {
                    this.quoteitems = response.data;
                    $('#quoteLineModal').modal('show');
                    $('#print').attr("href", '/quotes/print/' + this.quote.id);
                    $('#downloadExcel').attr("href", '/quotes/pdf/' + this.quote.id);
                })

        },
        contactstorecomment() {
            axios.put('api/contacts/comments/' + this.contact.id, {
                    title: this.comment.title,
                    body: this.comment.body
                })
                .then(response => {
                    this.comment = response.data;
                    this.loadcomments();
                });
        },
        loadcomments() {
            axios.get('api/contacts/comments/' + this.contact.id)
                .then(response => {
                    this.comments = response.data;
                });
        },
        loadattachmens() {
            axios.get('api/contacts/attachmens/' + this.contact.id)
                .then(response => {
                    this.attachmens = response.data;
                });
        },
        inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                // Before adding a file

                if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
                    return prevent()
                }
                // Filter php html js file
                if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                    return prevent()
                }
            }
        },
        inputFile(newFile, oldFile) {
            if (newFile && !oldFile) {
                // add
                console.log('add', newFile)
            }
            if (newFile && oldFile) {
                // update
                console.log('update', newFile)
            }
            if (!newFile && oldFile) {
                // remove
                console.log('remove', oldFile)
            }
        },
        taokehoach() {
            axios.put('api/contacts/tasks/' + this.contact.id, {
                    title: this.taskcontact.title.name,
                    task: this.taskcontact.task,
                    priority: this.taskcontact.priority,
                    duedate: this.taskcontact.duedate,
                    user_id: this.taskcontact.user.id
                })
                .then(response => {
                    this.taskcontact = response.data;
                    this.taivekehoach();
                    $('#taskModal').modal('hide');
                });
        },
        taivekehoach(id) {
            axios.get('api/contacts/tasks/' + this.contact.id)
                .then(response => {
                    this.tasks = response.data;
                });
        },
        taohanhdong() {
            axios.put("api/contacts/activities/" + this.contact.id, {
                    subject: this.activity.subject.name,
                    date_start: this.activity.date_start,
                    due_date: this.activity.due_date,
                    time_start: this.activity.time_start,
                    time_end: this.activity.time_end,
                    status: this.activity.status,
                    note: this.activity.note,
                })
                .then(response => {
                    this.activity = response.data;
                    this.taivehoatdong();
                    $("#actionModal").modal('hide');
                })
                .catch(response => {

                })
        },
        taivehoatdong(id) {
            axios.get('api/contacts/activities/' + this.contact.id)
                .then(response => {
                    this.activities = response.data;
                });
        },
        showmodelaction() {
            this.activity.date_start = moment().format().split("T")[0];
            this.activity.due_date = moment().format().split("T")[0];
            this.activity.time_start = moment().format('LT');
            this.activity.time_end = moment().format('LT');
            $("#actionModal").modal('show');
        },
        download($attachmen) {
            location.replace("/attachmens/" + $attachmen);
        },
        chon(task) {
            this.task = task;
            this.showmodelaction();
        },
        editcontact(id) {
            axios.post("/setcontact", { id: id })
                .then(response => {
                    location.replace("/them-khach-tiem-nang")
                })
        },
        themvideo() {
            axios.put('api/contacts/videos/' + this.contact.id, {
                    title: this.youtube_id,
                })
                .then(response => {
                    this.youtube_id = '';
                    this.loadVideos();
                });
        },
        loadCostcenters() {

        },

        //KH15
        loadKh15s(){
            axios.get('api/contacts/kh15s/' + this.contact.id)
            .then(response => {
                this.kh15s = response.data;
            });
        },

        addKh15(){
            axios.put('api/contacts/kh15s/' + this.contact.id, {
                name: this.kh15.name,
                description: this.kh15.description
            })
            .then(response => {
                this.kh15Types.name = '';
                this.loadKh15s();
            });
        },

        //Lost
        loadLosts(){
            axios.get('api/contacts/losts/' + this.contact.id)
            .then(response => {
                this.losts = response.data;
            });
        },

        addLost(){
            axios.put('api/contacts/losts/' + this.contact.id, {
                name: this.lost.name,
                description: this.lost.description
            })
            .then(response => {
                this.lostTypes.name = '';
                this.loadLosts();
            });
        },
        taskCompleted(task){
            axios.post('api/tasks/completed/' + task.id)
            .then(response => {
                this.taivekehoach();
            });
        },
        deleteTask(task){
            axios.delete('api/tasks/' + task.id)
            .then(response => {
                this.taivekehoach();
            });
        }
    },
    created() {
        this.loadcontact();
        this.loadquotes();
        
        axios.get('api/picklists/contact-picklists')
        .then(response => {
            this.users = response.data.users;
            this.activityTypes = response.data.activity_types;
            this.coscenters = response.data.coscenters;

        });
    }
}

</script>
