<template>
  <div class="main" style="min-width: 1400px">
    <h1>首页图片编辑</h1>
    <div v-for="(item,index) in imgList">
      <el-row style="height: 200px" type="text" justify="" >
        <el-col :span="2" style="height: 178px;line-height: 178px">
          图{{ index+1 }}
        </el-col>
        <el-col :span="5">
          <el-upload
            :show-file-list="false"
            :on-success="handleAvatarSuccess"
            :data="{'index':index}"
            :action="actionUrl"
            name="image"
            class="avatar-uploader">
            <img v-if="item.img_url" :src="item.img_url" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"/>
          </el-upload>
        </el-col>
        <el-col :span="5">
          <div style="height: 178px;line-height: 178px">
            <el-row>
              <el-col :span="6">跳转地址:</el-col>
              <el-col :span="12"><el-input v-model="item.jump_url" style="width: 180px"/></el-col>
            </el-row>
          </div>
        </el-col>
        <el-col :span="3" style="height: 178px;line-height: 178px">
          <el-button type="primary" icon="el-icon-delete" @click="delImage(index)"/>
        </el-col>
      </el-row>
    </div>
    <el-button type="primary" @click="addImage">添加</el-button>
    <el-button type="primary" @click="saveData">保存</el-button>
  </div>
</template>

<script>
import { getHomeImageData, saveHomeImageData } from '@/api/request'
export default {
  data() {
    return {
      imgList: [
      ],
      actionUrl: process.env.BASE_API + 'admin/upload/uploadImg',
      imageUrl: ''
    }
  },
  mounted: function() {
    this.getData()
  },
  methods: {
    getData() {
      getHomeImageData().then(response => {
        this.imgList = response.data
      })
    },
    handleAvatarSuccess(res, file) {
      this.imgList[res.data.index].img_url = res.data.img_url
    },
    saveData() {
      saveHomeImageData({ imgList: this.imgList }).then(response => {
        this.$message({
          message: '保存成功!',
          type: 'success'
        })
      })
    },
    delImage(index) {
      this.imgList.splice(index, 1)
    },
    addImage() {
      this.imgList.push(
        {
          'id': 0,
          'img_url': '',
          'jump_url': ''
        }
      )
    }
  }
}
</script>

<style scoped>
  .main{
    margin: 50px 50px;
  }
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>

