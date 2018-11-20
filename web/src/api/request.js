import request from '@/utils/request'

export function getHomeImageData() {
  return request({
    url: '/admin/home/getHomeImageData',
    method: 'get'
  })
}
export function saveHomeImageData(imgList) {
  return request({
    url: '/admin/home/saveHomeImageData',
    method: 'post',
    data: imgList
  })
}
