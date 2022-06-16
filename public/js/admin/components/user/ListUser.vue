<template>    
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Danh sách người dùng</h3>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ảnh người dùng</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in users" :key="item.id">
                                            <td><img :src="item.profile_photo_path" alt="" width="50px"></td>
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.email }}</td>
                                            <td>
                                                <a href=""
                                                    :data-url="`/admin/user/delete/${item.id}`"
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
            users: Array,
            total: Number,
            lastPage: Number
        },
    }
</script>

<style lang="scss" scoped>

</style>