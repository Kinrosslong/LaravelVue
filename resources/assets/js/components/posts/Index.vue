<template>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Laravel axios 请求 文章首页列表</div>
                    <div class="panel-body">
                        <div v-for="post in posts"  :key="post.id" class="bs-callout bs-callout-danger ">
                            <h4><router-link :to="{name:'posts', params:{id: post.id}}">{{post.title}}</router-link></h4>
                            <p>{{post.body}}</p>
                        </div>
                    </div>

                    <!--传统方式 遍历数据 渲染表格-->
                    <div class="table-responsive" id="user-table">
                        <table class="table table-striped table-bordered table-style  table-nbacfg table-responsive jambo_table bulk_action">
                            <thead>
                                <tr >
                                    <th>ID </th>
                                    <th>用户ID</th>
                                    <th>标题</th>
                                    <th>内容</th>
                                    <th>创建时间</th>
                                    <th>操作 </th>
                                </tr>
                            </thead>
                            <tbody id="table-list">
                                <tr v-for="post in posts" :key="post.id" >
                                    <td>{{post.id}}</td>
                                    <td>{{post.user_id}}</td>
                                    <td>{{post.title}}</td>
                                    <td>{{post.body}}</td>
                                    <td>{{post.created_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" @click="dialogFormVisible = true">编辑</button>
                                        <button type="button" class="btn btn-danger">删除</button>

                                        <!-- <el-button type="primary">这是element按钮上传</el-button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!--Element 表格渲染-->
                        <!--分页-->
                        <el-pagination background layout="total, prev, pager, next, jumper"  :total="total"   :page-size="pagesize"  
                            @size-change="initShow" 
                            @current-change="initShow">
                        </el-pagination>

                        <!-- Element Dialog对话框-->
                        <el-dialog title="Post 编辑" :visible.sync="dialogFormVisible"  width="60%">
                            <el-form :model="dialogEdit">
                                <el-form-item label="标题" :label-width="formLabelWidth">
                                    <el-input v-model="dialogEdit.title" auto-complete="off"></el-input>
                                </el-form-item>
                                <el-form-item label="活动区域" :label-width="formLabelWidth">
                                <el-select v-model="dialogEdit.region" placeholder="请选择活动区域">
                                    <el-option label="区域一" value="shanghai"></el-option>
                                    <el-option label="区域二" value="beijing"></el-option>
                                </el-select>
                                </el-form-item>
                                <el-form-item label="标题" :label-width="formLabelWidth">
                                    <el-input type="textarea" :rows="5" placeholder="请输入内容" v-model="dialogEdit.body">
                                    </el-input>
                                </el-form-item>
                            </el-form>
                            <div slot="footer" class="dialog-footer">
                                <el-button @click="dialogFormVisible = false">取 消</el-button>
                                <el-button type="primary" @click="edit">确 定</el-button>
                            </div>
                        </el-dialog>
                        <!-- Element Dialog对话框 -->
                    </div>
                </div>
            </div>
        </div>
</template>
<style>
    .el-dialog .el-input__inner {
        width: 450px;
    }
    .el-dialog .el-textarea__inner {
        width: 450px;
    }
</style>
<script>
    import Posts from './../posts/Index.vue';
    export default {

        components: {
            Posts
        },
        data() {
            return {
                posts: [],
                radio: '1',
                input: '123',
                switch1: true,
                switch2: true,
                formInline: {
                    user: '',
                    region: ''
                },
                total: 0,
                pagesize: 5,
                dialogFormVisible: false,
                dialogEdit: {
                    name: '',
                    region: '',
                    body:''
                },
                formLabelWidth: '120px',
            }
        },
        mounted() {
            this.initShow(1);
        },
        methods: { 
            onSubmit() {
                console.log('submit!');
                console.log(this.formInline.region);
                console.log(this.formInline.user);
            },
            //初始化
            initShow(pagenum) {
                axios.get('/api/posts',{params:{pagenum:pagenum, pagesize:this.pagesize}}).then(res => {
                    console.log(res);
                    this.total = res.data.total;
                    this.posts = res.data.data;
                })
            },
            edit() {
                this.dialogFormVisible = false;
                //js es6的新写法吧可能
                let fromData = {
                    neme: dialogEdit.name,
                    region: dialogEdit.region,
                    body: dialogEdit.body
                }
                //vue 路由地址跳转  name 就是 routes.js里面的路由方法名称
                this.$router.push({name: postEdit});
                console.log();
            }
        }

    }
</script>
