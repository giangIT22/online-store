<template>    
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Danh sách nhân viên</h3>
                                <a href="/admin/employee/create" type="button" class="btn btn-rounded btn-primary mb-5">Thêm</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ảnh nhân viên</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in employees" :key="item.id">
                                            <td><img :src="item.profile_photo_path" alt="" width="50px"></td>
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.email }}</td>
                                            <td>
                                                <a :href="`/admin/employee/edit/${item.id}`"
                                                    class="btn btn-info" title="Edit Data"><i
                                                        class="fa fa-pencil"></i> </a>
                                                <a href=""
                                                    :data-url="`/admin/employee/delete/${item.id}`"
                                                    class="btn btn-danger action-delete" title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <paginate :page-count="lastPage"></paginate>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</template>

<script>    
    import Paginate from '../Paginate.vue'

    export default {
        components: { Paginate },
        props: {
            employees: Array,
            total: Number,
            lastPage: Number
        },
    }
</script>

<style lang="scss" scoped>

</style>