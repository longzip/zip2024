<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Khách hàng tiềm năng</h3>
                        <div class="card-tools">
                            <!-- Button trigger modal -->
                            <a href="#" @click="newcontact()" class="btn btn-primary">
                                Thêm khách hàng tiềm năng
                            </a>
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
                                <tr v-for="contact in contacts" :key="contact.id">
                                    <td><a href="#" @click="ttkhachtiemnang(contact.id)">{{ contact.first_name }} {{ contact.last_name }}</a></td>
                                    <td>{{ contact.phone }}</td>
                                    <td>{{ contact.email }}</td>
                                    <td>{{ contact.address }}, {{ contact.city }}</td>
                                    <td>{{ contact.created_at | myDate}}</td>
                                    <td>
                                        <a href="#" @click="editcontact(contact.id)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(contact.id)">
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
    </div>
</template>
<script>
export default {
    data() {
        return {
            contacts: {},

        }
    },

    methods: {
        loadcontacts(){
            axios.get('/api/contacts')
            .then(response => {
                this.contacts = response.data.data;
            })
        },
        editcontact(id){
            axios.post("/setcontact", {id: id})
            .then(response => {
                location.replace("/them-khach-tiem-nang")
            })
        },
        newcontact(){
            axios.get("/clearcontact")
            .then(response => {
                location.replace("/them-khach-tiem-nang")
            })
        },
        ttkhachtiemnang(id){
            axios.post("/setcontact", {id: id})
            .then(response => {
                location.replace("/thong-tin-khach-tiem-nang")
            })
        }
    },
    created() {
        this.loadcontacts();
    }
}

</script>
