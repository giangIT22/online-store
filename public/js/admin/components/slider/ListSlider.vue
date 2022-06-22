<template>    
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Danh sách Slider</h3>
                                <a href="/admin/slider/create" type="button" class="btn btn-rounded btn-primary mb-5">Thêm</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ảnh slider</th>
                                            <th>Tiêu đề</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in sliders" :key="item.id">
                                            <td><img :src="item.slider_image" alt="" width="50px"></td>
                                            <td>{{ item.title }}</td>
                                            <td>{{ item.description }}</td>
                                            <td>
                                                <span v-if="item.status == 1" class="badge badge-pill badge-success"> Active </span>
                                                <span v-if="item.status == 0" class="badge badge-pill badge-danger">Not Active </span>
                                            </td>
                                            <td>
                                                <a :href="`/admin/slider/edit/${item.id}`"
                                                    class="btn btn-info" title="Edit Data"><i
                                                        class="fa fa-pencil"></i> </a>
                                                <a href=""
                                                    :data-url="`/admin/slider/delete/${item.id}`"
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
            sliders: Array,
            total: Number,
            lastPage: Number
        },
    }
</script>

<style lang="scss" scoped>

</style>