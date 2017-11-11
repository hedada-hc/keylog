<template>
    <el-container>
        <el-aside width="200px">
            <el-menu default-active="2" class="el-menu-vertical-demo">
                  <el-menu-item index="2">
                    <i class="el-icon-menu"></i>
                    <span slot="title">添加url</span>
                  </el-menu-item>
                  <el-menu-item index="3">
                    <i class="el-icon-setting"></i>
                    <span slot="title">用户管理</span>
                </el-menu-item>
            </el-menu>
        </el-aside>
        <el-container>
            <el-header>
                <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" >
                  <el-menu-item index="1"><a href="/admin/index" target="_blank">首页</a></el-menu-item>
                </el-menu>
            </el-header>
            <el-main>
                <el-row>
                  <el-col :span="24"><div class="grid-content bg-purple-dark">
                        <el-button type="primary" @click="exportXLS">导出XLS<i class="el-icon-upload el-icon--right"></i></el-button>
                        <el-date-picker v-model="value6" value-format="yyyy-MM-dd" type="daterange" range-separator="至" start-placeholder="开始日期" end-placeholder="结束日期"> </el-date-picker>
                  </div></el-col>
                </el-row>
                <el-table
                    :data="tableData"
                    style="width: 100%">
                    <el-table-column prop="id" label="ID" width="60"> </el-table-column>
                    <el-table-column prop="referer" label="来源地址" > </el-table-column>
                    <el-table-column prop="keyword" label="关键词" width="180"> </el-table-column>
                    <el-table-column prop="region" label="地区" width="180"> </el-table-column>
                    <el-table-column prop="ip" label="IP地址" width="180"> </el-table-column>
                    <el-table-column prop="domain" label="搜索引擎" width="100"
                      :filters="[{ text: '百度', value: '百度' }, { text: '搜狗', value: '搜狗' },{ text: '神马', value: '神马' }]"
                      :filter-method="filterTag"
                      filter-placement="bottom-end">
                      <template slot-scope="scope">
                        <el-tag v-if="scope.row.domain == '百度'" type="primary" close-transition>{{scope.row.domain}}</el-tag>
                        <el-tag v-else-if="scope.row.domain == '搜狗'" type="danger" close-transition>{{scope.row.domain}}</el-tag>
                        <el-tag v-else type="warning" close-transition>{{scope.row.domain}}</el-tag>
                      </template>
                    </el-table-column>
                    <el-table-column prop="user_agent" label="操作系统" width="100"
                      :filters="[{ text: 'Windows', value: 'Windows' }, { text: 'iPhone', value: 'iPhone' },{ text: 'iPad', value: 'iPad' },{ text: 'Android', value: 'Android' },{ text: 'Nokia', value: 'Nokia' },{ text: 'PlayBook', value: 'PlayBook' },{ text: 'Mac', value: 'Mac' }]"
                      :filter-method="filterTag"
                      filter-placement="bottom-end">
                      <template slot-scope="scope">
                        <el-tag
                          :type="scope.row.user_agent === 'Windows' ? 'primary' : 'success'"
                          close-transition>{{scope.row.user_agent}}</el-tag>
                      </template>
                    </el-table-column>
                    <el-table-column prop="created_at" label="日期" sortable width="180"></el-table-column>
                  </el-table>
                    
                    <el-row class="page" style="margin-left:0px;margin-right:0px;" :gutter="20">
                      <el-col :span="12" :offset="8"><div class="grid-content bg-purple">
                            <el-pagination
                              @size-change="handleSizeChange"
                              @current-change="handleCurrentChange"
                              :current-page.sync="currentPage1"
                              :page-size="50"
                              layout="total, prev, pager, next"
                              :total="count">
                            </el-pagination>
                      </div></el-col>
                    </el-row>
            </el-main>
        </el-container>
    </el-container>
</template>
<script>
    export default {
        data() {
            return {
                tableData: [],
                activeIndex:"1",
                defaultActive:"",
                value6:"",
                currentPage1:1,
                count:0
            }
        },
        mounted() {
            this.queryKey();
        },
        methods:{
            queryKey(){
                axios.get("/admin/v1/page?page=1").then(response => {
                    this.tableData = response.data.result;
                    this.count = response.data.count
                })
            },
            filterTag(){
                alert("sdsdsd");
            },
            formatter(){

            },
            exportXLS(){
                var url = "/admin/export?start="+this.value6[0]+"&end="+this.value6[1];
                axios.get(url).then(response => {
                    if(response.data.code == 404){
                        this.$notify({
                            title:"查询错误",
                            message:response.data.message,
                            type:"error",
                            duration: 0
                        })
                    }else{
                        window.location.href = url;
                        this.$notify({
                            title:"查询成功",
                            message:"正在查询 "+this.value6[0]+" 至 "+this.value6[1]+" 期间的数据",
                            type:"success"
                        }) 
                    }

                })
            },
            handleSizeChange(val) {
                console.log(`每页 ${val} 条`);
            },
            handleCurrentChange(val) {
                axios.get("/admin/v1/page?page="+val).then(response => {
                    this.tableData = response.data.result;
                    this.count = response.data.count;
                })
            }
        }
    }
</script>

<style type="text/css">
    .el-header{
        padding: 0px;
    }

    .el-carousel__item h3 {
        color: #475669;
        font-size: 14px;
        opacity: 0.75;
        line-height: 150px;
        margin: 0;
    }

    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }
  
    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }
    .el-menu{
        height: 100%;
    }
    .el-row{
        background-color: #ffffff;
        padding: 20px;
    }
    .el-button--primary{
        float: right;
    }
    .page{
        margin-left:0px;
        margin-right:0px;
    }
</style>