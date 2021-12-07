<template>    
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Sub Category List</h3>
                                <a href="/admin/category/sub/create" type="button" class="btn btn-rounded btn-primary mb-5">Add</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in subCategory" :key="item.id">
                                            <td>{{ item.sub_category_name }}</td>
                                            <td>{{ item.sub_category_slug }}</td>
                                            <td>
                                                <a :href="`/admin/category/sub/edit/${item.id}`"
                                                    class="btn btn-info" title="Edit Data"><i
                                                        class="fa fa-pencil"></i> </a>
                                                <a href=""
                                                    :data-url="`/admin/category/sub/delete/${item.id}`"
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
            subCategory: Array,
            total: Number,
            lastPage: Number
        },
    }
</script>

<style lang="scss" scoped>

</style>