<template>
    <div class="container mt-5">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info-active">
                        <h3 class="widget-user-username">{{ kh15.first_name}} {{ kh15.last_name}} ({{ kh15.company}})</h3>
                        <h5>{{ kh15.phone}} | {{ kh15.email}} | {{ kh15.address}}, {{ kh15.city}}</h5>
                    </div>
                    <div class="card-footer">
                        {{ kh15.note}}<br>
                        {{ kh15.description}}
                    </div>
                </div>
                <tabs>
                    <tab name="Hoạt động">
                        <a class="btn btn-primary" @click="showmodelaction()" tabindex="-1" href="#">Tạo hoạt động</a>
                        <div v-for="item in activities">
                            <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{item.status}}
                                    <h5><i class="icon fa fa-info"></i> <a href="#">{{item.subject}}</a></h5>
                                    {{item.date_start | myDate}} lúc {{item.time_start}}<br>
                                    {{item.note}}<br>


                            </div>
                            </div>
                    </tab>
                    <tab name="Bình luận">
                        
                    </tab>
                    <tab name="Tài liệu">
                        
                    </tab>
                    <tab name="Báo giá">
                        
                    </tab>
                </tabs>
            </div>
            <!-- /.col -->
        </div>
        <!-- Modal -->
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
                                <input v-model="activity.subject" type="text" class="form-control" placeholder="Hoạt động *">
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
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select v-model="activity.status" class="form-control">
                                    <option>Chưa bắt đầu</option>
                                    <option>Đang thực hiện</option>
                                    <option>Hoàn thành</option>
                                    <option>Lên kế hoạch</option>
                                </select>
                            </div>
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
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: new Form({
                title: '',
                first_name: '',
                last_name: '',
                phone: '',
                company: '',
                
            }),
            kh15: {},
            activity: {
                subject: '',
                date_start: '',
                due_date: '',
                time_start: '',
                time_end: '',
                status: '',
                note: '',
            },
            activities: {}
        }
    },
    methods: {
        taokh15() {
            this.$Progress.start();
            this.form.post('api/kh15')
                .then(() => {
                    this.taivekh15();
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        taivekh15() {
            axios.get("getkh15")
                .then(response => {
                    this.kh15 = response.data;
                    this.taivehoatdong(this.kh15.id);
                });
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
        taohanhdong() {
            axios.post("/api/activities", {
                    subject: this.activity.subject,
                    date_start: this.activity.date_start,
                    due_date: this.activity.due_date,
                    time_start: this.activity.time_start,
                    time_end: this.activity.time_end,
                    status: this.activity.status,
                    note: this.activity.note,
                    kh15_id: this.kh15.id
                })
                .then(response => {
                    this.taivehoatdong(this.kh15.id);
                    $("#actionModal").modal('hide');
                })
                .catch(response => {

                })
        },
        taivehoatdong(id) {
            axios.get("/api/activitybykh15/" + id)
                .then(({ data }) => (this.activities = data));
        },
        showmodelaction() {
            this.activity.date_start = moment().format().split("T")[0];
            this.activity.due_date = moment().format().split("T")[0];
            this.activity.time_start = moment().format('LT');
            this.activity.time_end = moment().format('LT');
            $("#actionModal").modal('show');
        }
    },
    created() {
        this.taivekh15();
    }
}

</script>
